<div class="p-6">
    <div class="bg-white shadow-md rounded-lg p-6">
        <div class="text-center mb-8">
            <h2 class="text-3xl font-bold text-gray-800">Organizing</h2>
            <div class="w-16 h-[2px] bg-blue-500 mx-auto my-2"></div>
            <p class="text-gray-600">Struktur Kepanitiaan</p>
        </div>

        <div class="flex flex-wrap gap-6 {{ count($organizings) === 1 ? 'justify-start' : 'justify-center' }}">
            @forelse($organizings as $org)
                <div class="relative overflow-hidden rounded-md shadow-md group cursor-pointer w-[300px]"
                     onclick="window.open('{{ asset('uploads/organizing/' . $org->pdf_file) }}', '_blank')">
                    
                    <div class="bg-gray-200 w-full h-[400px] rounded-md overflow-hidden">
                        <canvas id="pdf-thumb-organizing-{{ $org->id }}" class="block w-[300px] h-[400px]"></canvas>
                    </div>

                    <div class="absolute left-1/2 bottom-[15px] transform -translate-x-1/2 translate-y-6 opacity-0 group-hover:translate-y-0 group-hover:opacity-100 transition-all duration-300">
                        <div class="bg-black/70 px-3 py-[5px] rounded-full">
                            <h3 class="text-white text-sm font-semibold text-center whitespace-nowrap">
                                {{ $org->title }}
                            </h3>
                        </div>
                    </div>
                </div>

                <script>
                    document.addEventListener("DOMContentLoaded", function() {
                        renderPdfThumbnail(
                            "{{ asset('uploads/organizing/' . $org->pdf_file) }}",
                            "pdf-thumb-organizing-{{ $org->id }}",
                            300, 400
                        );
                    });
                </script>
            @empty
                <p class="text-gray-500 text-center col-span-full">Tidak ada dokumen organizing yang tersedia.</p>
            @endforelse
        </div>
    </div>
</div>

<script>
    async function renderPdfThumbnail(url, canvasId, width, height) {
        try {
            const canvas = document.getElementById(canvasId);
            if (!canvas) return;

            const loadingTask = pdfjsLib.getDocument(url);
            const pdf = await loadingTask.promise;
            const page = await pdf.getPage(1);

            const baseViewport = page.getViewport({ scale: 1 });
            // Hitung scale "cover"
            const scale = Math.max(width / baseViewport.width, height / baseViewport.height);
            
            const viewport = page.getViewport({ scale });
            
            // Offscreen canvas
            const offCanvas = document.createElement('canvas');
            offCanvas.width = Math.ceil(viewport.width);
            offCanvas.height = Math.ceil(viewport.height);
            
            await page.render({
                canvasContext: offCanvas.getContext('2d'),
                viewport: viewport
            }).promise;

            // Drawing ke canvas target (Crop align left & center vertical)
            canvas.width = width;
            canvas.height = height;
            const ctx = canvas.getContext('2d');
            
            const sx = 0; // Align left
            const sy = Math.max(0, Math.floor((offCanvas.height - height) / 2));
            
            ctx.drawImage(
                offCanvas, 
                sx, sy, width, height,
                0, 0, width, height
            );
        } catch (error) {
            console.error("Error rendering PDF thumb:", error);
        }
    }
</script>