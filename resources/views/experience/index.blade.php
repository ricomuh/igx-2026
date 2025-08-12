@extends('layouts.main', [
    'title' => 'Experience',
])

@push('style')
<style>
    body {
        background-color: var(--color-primary) !important;
    }
    iframe {
        display: block;
        aspect-ratio: 16 / 9;
        min-height: 250px;
    }

    .fullscreen-mode {
        position: fixed;
        top: 0;
        left: 0;
        width: 100vw;
        height: 100vh;
        z-index: 9999;
        background-color: var(--color-primary);
    }

    .fullscreen-mode iframe {
        height: 100vh !important;
        width: 100vw !important;
    }

    .iframe-fullscreen {
        position: fixed !important;
        top: 0 !important;
        left: 0 !important;
        width: 100vw !important;
        height: 100vh !important;
        z-index: 10000 !important;
        border: none !important;
    }
</style>
@endpush

@section('content')
<div class="container mx-auto px-5 xl:px-12 pt-28">
    <h1 class="text-3xl md:text-4xl xl:text-5xl text-white text-center font-extrabold text-shadow-lg">IGX Fusion Celebration</h1>

    {{-- leaderboard table contains: number, username, score--}}
    <div class="mt-20">
        <h2 class="text-xl font-bold text-white mb-4 text-shadow-lg">Leaderboard This Week</h2>
        <table class="min-w-full divide-y divide-gray-200 rounded-2xl overflow-hidden ring-2 ring-info/50 shadow-2xl">
            {{-- leaderboard header --}}
            {{-- leaderboard title --}}
            <thead class="bg-info text-white">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">#</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Username</th>
                    <th class="px-6 py-3 text-left text-xs font-medium uppercase tracking-wider">Score</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-700">
                @foreach ($leaderboard as $index => $entry)
                    <tr
                    @php
                        $rowClass = '';
                        if ($index == 0) {
                            $rowClass = 'bg-gradient-to-r from-info to-primary text-white hover:to-info';
                        } elseif ($index == 1) {
                            $rowClass = 'bg-gradient-to-r from-secondary to-primary text-white hover:to-info';
                        } elseif ($index == 2) {
                            $rowClass = 'bg-gradient-to-r from-tertiary to-primary hover:to-info';
                        }
                    @endphp
                    class="{{ $rowClass }} text-gray-800 hover:bg-info hover:text-white duration-200"
                    >
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $entry->username }}</td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm">{{ $entry->score }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <div id="main" class="my-8 md:my-10 xl:my-12"></div>


    <div class="flex justify-center">
      <button id="fullscreenBtn" class="btn-primary font-extrabold text-lg px-5 sm:px-6 md:px-7 py-3 sm:py-4 rounded-lg uppercase cursor-pointer flex items-center gap-2">
        <svg
          xmlns="http://www.w3.org/2000/svg"
          fill="none"
          viewBox="0 0 24 24"
          stroke-width="3"
          stroke="currentColor"
          class="w-6 h-6"
        >
          <path
            stroke-linecap="round"
            stroke-linejoin="round"
            d="M3.75 3.75v4.5m0-4.5h4.5m-4.5 0L9 9M3.75 20.25v-4.5m0 4.5h4.5m-4.5 0L9 15M20.25 3.75h-4.5m4.5 0v4.5m0-4.5L15 9m5.25 11.25h-4.5m4.5 0v-4.5m0 4.5L15 15"
          />
        </svg>
        <span>Fullscreen</span>
      </button>
    </div>
</div>
@endsection

@push('scripts')
  <script>
      window.mobileAndTabletCheck = function () {
        let check = false;
        (function (a) {
          if (
            /(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|mobile.+firefox|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows ce|xda|xiino|android|ipad|playbook|silk/i.test(
              a
            ) ||
            /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(
              a.substr(0, 4)
            )
          )
            check = true;
        })(navigator.userAgent || navigator.vendor || window.opera);
        return check;
      };

      const version = "3.3";
      let isFullscreen = false;

      //  create iframe
      const createIframe = (container) => {
        const src = mobileAndTabletCheck()
          ? `https://experience.igx.co.id/${version}-mob`
          : `https://experience.igx.co.id/${version}`;
        container.innerHTML = `<iframe src="${src}" style="width: 100%; border: none;"></iframe>`;
      }

      // enter fullscreen
      const enterFullscreen = () => {
        const mainDiv = document.getElementById("main");
        const iframe = mainDiv.querySelector('iframe');

        if (iframe) {
          iframe.classList.add('iframe-fullscreen');
          document.body.style.overflow = "hidden";
          isFullscreen = true;

          // Request browser fullscreen
          if (iframe.requestFullscreen) {
            iframe.requestFullscreen().catch(err => {
              console.log("Fullscreen API not supported or blocked");
            });
          } else if (iframe.webkitRequestFullscreen) {
            iframe.webkitRequestFullscreen();
          } else if (iframe.msRequestFullscreen) {
            iframe.msRequestFullscreen();
          }
        }
      }

      // exit fullscreen
      const exitFullscreen = () => {
        const mainDiv = document.getElementById("main");
        const iframe = mainDiv.querySelector('iframe');

        if (iframe) {
          // Hapus class fullscreen untuk mengembalikan iframe ke posisi normal
          iframe.classList.remove('iframe-fullscreen');
          document.body.style.overflow = "auto";
          isFullscreen = false;
        }

        // Exit browser's fullscreen if active
        if (document.exitFullscreen) {
          document.exitFullscreen().catch(err => {
            console.log("Not in browser fullscreen mode");
          });
        } else if (document.webkitExitFullscreen) {
          document.webkitExitFullscreen();
        } else if (document.msExitFullscreen) {
          document.msExitFullscreen();
        }
      }

      document.addEventListener("DOMContentLoaded", function () {
        const mainDiv = document.getElementById("main");
        const fullscreenBtn = document.getElementById("fullscreenBtn");
        createIframe(mainDiv);

        // Fullscreen button event
        fullscreenBtn.addEventListener("click", enterFullscreen);

        // Handle ESC key to exit fullscreen
        document.addEventListener("keydown", function(event) {
          if (event.key === "Escape" && isFullscreen) {
            exitFullscreen();
          }
        });

        document.addEventListener("fullscreenchange", function() {
          if (!document.fullscreenElement && isFullscreen) {
            exitFullscreen();
          }
        });

        document.addEventListener("webkitfullscreenchange", function() {
          if (!document.webkitFullscreenElement && isFullscreen) {
            exitFullscreen();
          }
        });

        document.addEventListener("msfullscreenchange", function() {
          if (!document.msFullscreenElement && isFullscreen) {
            exitFullscreen();
          }
        });
      });
    </script>
@endpush
