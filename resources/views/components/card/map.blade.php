<div id="mapWidget" class="fixed bottom-12 -right-12 scale-90 hover:scale-100 hover:right-5 duration-200 z-50 group" style="display: none;">
  <div class="relative bg-white rounded-xl shadow-2xl transform transition-all duration-300 hover:scale-105 ring-1 ring-black/50 ">
    <p class="absolute left-1/2 text-white -translate-1/2 z-[999] text-sm text-title text-center">Map IGX</p>
    <!-- Close Button -->
    <button onclick="hideMap()" class="absolute top-2 right-2 z-10 bg-black bg-opacity-50 hover:bg-opacity-70 text-white rounded-full w-6 h-6 flex items-center justify-center text-sm transition-all">
      ×
    </button>

    <!-- Map Image with Link -->
    <a href="{{ asset('media/images/gallery/full_map.webp') }}" target="_blank" class="block relative overflow-hidden rounded-xl">
      <img src="{{ asset('media/images/gallery/full_map.webp') }}" alt="IGX Event Map" class="w-56 h-auto rounded-xl" />

      <!-- Hover Overlay -->
      <div class="hidden absolute inset-0 bg-black/50 group-hover:bg-opacity-40 transition-all duration-300 group-hover:flex items-center justify-center">
        <span class="text-white font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-300 text-sm">
          See Full Map
        </span>
      </div>
    </a>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const mapWidget = document.getElementById('mapWidget');
  const isMapClosed = sessionStorage.getItem('map_closed');

  if (isMapClosed === 'true') {
    mapWidget.style.display = 'none';
  } else {
    // show map
    mapWidget.style.display = 'block';
  }
});

const hideMap = () => {
  const mapWidget = document.getElementById('mapWidget');
  mapWidget.style.display = 'none';

  sessionStorage.setItem('map_closed', 'true');
}
</script>

<style>
  .text-title {
    -webkit-text-stroke: 1px black;
  }
</style>
