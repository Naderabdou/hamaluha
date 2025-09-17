<div class="images_estate"
    style="display: grid; grid-template-columns: repeat(6, 1fr); gap: 10px; width: 100%; height: 300px; overflow: hidden;">

    @forelse ($record->images as $image)
    <a href="{{ $image->image_path }}" style="display: block; width: 100%; height: 100%;">
        <img src="{{ $image->image_path }}" alt="" style="width: 100%; height: 100%; object-fit: cover;" />
    </a>
    @empty
    <div class="alert alert-warning" role="alert">
        No images found
    </div>
    @endforelse
    <style>
        .sub-client-page img {
            max-height: 100% !important;
            max-width: 100% !important;
            object-fit: contain;
        }

        .mfp-with-zoom .mfp-container,
        .mfp-with-zoom.mfp-bg {
            opacity: 0;
            -webkit-backface-visibility: hidden;
            -webkit-transition: all 0.3s ease-out;
            -moz-transition: all 0.3s ease-out;
            -o-transition: all 0.3s ease-out;
            transition: all 0.3s ease-out;
        }

        .mfp-with-zoom.mfp-ready .mfp-container {
            opacity: 1;
        }

        .mfp-with-zoom.mfp-ready.mfp-bg {
            opacity: 0.8;
        }

        .mfp-with-zoom.mfp-removing .mfp-container,
        .mfp-with-zoom.mfp-removing.mfp-bg {
            opacity: 0;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('magnific-popup.css') }}">
    <script src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="{{ asset('jquery.magnific-popup.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('.images_estate').magnificPopup({
                delegate: 'a',
                type: 'image',
                gallery: {
                    enabled: true
                },
                mainClass: 'mfp-with-zoom', // This class is for the zoom animation
                zoom: {
                    enabled: true, // By default it's false, so don't forget to enable it
                    duration: 300, // Duration of the effect, in milliseconds
                    easing: 'ease-in-out', // CSS transition easing function
                    opener: function(openerElement) {
                        return openerElement.is('img') ? openerElement : openerElement.find('img');
                    }
                }
            });

        });
    </script>
</div>
