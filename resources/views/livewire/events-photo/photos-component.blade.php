<div>
    {{--     <style>
        /* From Uiverse.io by IWhat1 */ 
.container {
  height: 294px;
  width: 240px;
  color: yellow;
  perspective: 800px;
  font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
}

.card {
  width: 100%;
  height: 100%;
  background: black;
  border-radius: 2rem;
  position: relative;
  transition: transform 1500ms;
  transform-style: preserve-3d;
}

.card-top {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 10%;
  position: absolute;
  width: 50%;
  background-color: transparent;
  border: 2px solid black;
  top: 0;
  border-top: none;
  border-radius: 0 0 1rem 1rem;
  box-shadow: 0px 0px 10px 5px rgba(255, 255, 0, 0.7);
}

.card-top-para {
  font-size: 16px;
  font-weight: bold;
}

.container:hover > .card {
  cursor: pointer;
  transform: rotateX(180deg) rotateZ(-180deg);
}

.front,
.back {
  height: 100%;
  width: 100%;
  border-radius: 2rem;
  box-shadow: 0px 0px 10px 5px rgba(255, 255, 0, 0.7);
  position: absolute;
  backface-visibility: hidden;
  display: flex;
  flex-direction: column;
  align-items: center;
  justify-content: center;
  gap: 20px;
}

.back {
  background-color: black;
  transform: rotateX(180deg) rotateZ(-180deg);
}

.heading {
  font-size: 22px;
  font-weight: bold;
}

.follow {
  font-size: 16px;
  font-weight: 500;
}

.icons {
  display: flex;
  flex-direction: row;
  gap: 20px;
  margin-top: 20px;
}

    </style>

    <!-- From Uiverse.io by IWhat1 --> 
<div class="container">
  <div class="card">
    <div class="front">
      <div class="card-top">
        <p class="card-top-para">Profile</p>
      </div>
      
      <svg viewBox="0 0 16 16" class="bi bi-person-circle" fill="currentColor" height="100" width="100" xmlns="http://www.w3.org/2000/svg">
        <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0z"></path>
        <path d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8zm8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1z" fill-rule="evenodd"></path>
      </svg>
      <p class="heading"> Front Card </p>
      <p class="follow">Follow me for more...
    </p></div>
    <div class="back">
      <p class="heading">Follow Me</p>
      
      <svg viewBox="0 0 16 16" class="bi bi-person-add" fill="currentColor" height="100" width="100" xmlns="http://www.w3.org/2000/svg">
        <path d="M12.5 16a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7Zm.5-5v1h1a.5.5 0 0 1 0 1h-1v1a.5.5 0 0 1-1 0v-1h-1a.5.5 0 0 1 0-1h1v-1a.5.5 0 0 1 1 0Zm-2-6a3 3 0 1 1-6 0 3 3 0 0 1 6 0ZM8 7a2 2 0 1 0 0-4 2 2 0 0 0 0 4Z"></path>
        <path d="M8.256 14a4.474 4.474 0 0 1-.229-1.004H3c.001-.246.154-.986.832-1.664C4.484 10.68 5.711 10 8 10c.26 0 .507.009.74.025.226-.341.496-.65.804-.918C9.077 9.038 8.564 9 8 9c-5 0-6 3-6 4s1 1 1 1h5.256Z"></path>
      </svg>

      <div class="icons">
        
        <svg viewBox="0 0 16 16" class="bi bi-instagram" fill="currentColor" height="32" width="32" xmlns="http://www.w3.org/2000/svg">
          <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"></path>
        </svg>
        
        <svg viewBox="0 0 16 16" class="bi bi-twitter-x" fill="currentColor" height="32" width="32" xmlns="http://www.w3.org/2000/svg">
          <path d="M12.6.75h2.454l-5.36 6.142L16 15.25h-4.937l-3.867-5.07-4.425 5.07H.316l5.733-6.57L0 .75h5.063l3.495 4.633L12.601.75Zm-.86 13.028h1.36L4.323 2.145H2.865l8.875 11.633Z"></path>
        </svg>
        
        <svg viewBox="0 0 16 16" class="bi bi-whatsapp" fill="currentColor" height="32" width="32" xmlns="http://www.w3.org/2000/svg">
            <path d="M13.601 2.326A7.854 7.854 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.933 7.933 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.898 7.898 0 0 0 13.6 2.326zM7.994 14.521a6.573 6.573 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.557 6.557 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592zm3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.729.729 0 0 0-.529.247c-.182.198-.691.677-.691 1.654 0 .977.71 1.916.81 2.049.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232z"></path>
        </svg>
        
        <svg viewBox="0 0 16 16" class="bi bi-facebook" fill="currentColor" height="32" width="32" xmlns="http://www.w3.org/2000/svg">
          <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"></path>
        </svg>

      </div>
    </div>
  </div>
</div> --}}


    {{-- 
<style>
    /* From Uiverse.io by Javierrocadev */ 
.card {
  width: 250px;
  height: 300px;
  border-radius: 15px;
  background: rgba(105, 13, 197, 0.103);
  display: flex;
  flex-direction: column;
  position: relative;
  overflow: hidden;
}

.card::before {
  content: "";
  height: 100px;
  width: 100px;
  position: absolute;
  top: -40%;
  left: -20%;
  border-radius: 50%;
  border: 35px solid rgba(255, 255, 255, 0.102);
  transition: all .8s ease;
  filter: blur(.5rem);
}

.text {
  flex-grow: 1;
  padding: 15px;
  display: flex;
  flex-direction: column;
  color: aliceblue;
  font-weight: 900;
  font-size: 1.2em;
}

.subtitle {
  font-size: .6em;
  font-weight: 300;
  color: rgba(240, 248, 255, 0.691);
}

.icons {
  display: flex;
  justify-items: center;
  align-items: center;
  width: 250px;
  border-radius: 0px 0px 15px 15px;
  overflow: hidden;
}

.btn {
  border: none;
  width: 84px;
  height: 35px;
  background-color: rgba(247, 234, 234, 0.589);
  display: flex;
  align-items: center;
  justify-content: center;
}

.svg-icon {
  width: 25px;
  height: 25px;
  stroke: rgb(38, 59, 126);
}

.btn:hover {
  background-color: rgb(247, 234, 234);
}

.card:hover::before {
  width: 140px;
  height: 140px;
  top: -30%;
  left: 50%;
  filter: blur(0rem);
}   
</style>
<!-- From Uiverse.io by Javierrocadev --> 

	<div class="card">
		<div class="text">
			<img src="{{ asset('assets/img/user.png') }}" alt="" height="240">
		</div>
		<div class="icons d-flex justify-content-between">
			<a class="btn btn-successs" href="#">
				<i class="fas fa-edit"></i>
			</a>
			<a class="btn" href="#">
			<svg class="svg-icon" viewBox="0 0 20 20">
				<path d="M4.317,16.411c-1.423-1.423-1.423-3.737,0-5.16l8.075-7.984c0.994-0.996,2.613-0.996,3.611,0.001C17,4.264,17,5.884,16.004,6.88l-8.075,7.984c-0.568,0.568-1.493,0.569-2.063-0.001c-0.569-0.569-0.569-1.495,0-2.064L9.93,8.828c0.145-0.141,0.376-0.139,0.517,0.005c0.141,0.144,0.139,0.375-0.006,0.516l-4.062,3.968c-0.282,0.282-0.282,0.745,0.003,1.03c0.285,0.284,0.747,0.284,1.032,0l8.074-7.985c0.711-0.71,0.711-1.868-0.002-2.579c-0.711-0.712-1.867-0.712-2.58,0l-8.074,7.984c-1.137,1.137-1.137,2.988,0.001,4.127c1.14,1.14,2.989,1.14,4.129,0l6.989-6.896c0.143-0.142,0.375-0.14,0.516,0.003c0.143,0.143,0.141,0.374-0.002,0.516l-6.988,6.895C8.054,17.836,5.743,17.836,4.317,16.411"></path>
			</svg>
			</a>
		</div>
	</div> --}}

    <style>
        /* From Uiverse.io by Daniel1227k */
        .my-card {
            position: relative;
            height: 254px;
            display: flex;
            justify-content: center;
            align-items: center;
            overflow: hidden;
            border-radius: 12px;
        }

        .my-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(315deg, #03a8f456, #ff0058);
            opacity: 0;
            transition: opacity 0.2s ease;
            z-index: 1;
            pointer-events: none;
        }

        .my-card:hover::before {
            opacity: 1;
        }

        .my-card img {
            position: absolute;
            z-index: 3;
            scale: 0.9;
            opacity: 0.9;
            transition: 0.5s;
        }

        .my-card:hover img {
            scale: 0.5;
            opacity: 0.5;
            transform: translateY(-70px);
        }

        .my-card .content-my {
            position: absolute;
            z-index: 3;
            bottom: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            transform: scale(0);
            transition: 0.5s;
        }

        .my-card:hover .content-my {
            transform: scale(1);
            bottom: 25px;
        }
    </style>

    <x-card-header title="Administracion de fotografias" name="Fotografias" />

    <x-card-body>
        <x-slot name="header">
            <h4><strong>{{ $this->title }} | {{ $this->date }}</strong></h4>
        </x-slot>
        <div class="row g-2">
            @forelse ($photos as $photo)
                <div class="col-md-4">
                    <div class="my-card w-100 position-relative">
                        <img src="{{ $photo->image }}" alt="">
                        <div class="content-my">

                            <div class="position-absolute bottom-0  d-flex gap-2  justify-content-center  ">
                                <button type="button" wire:target="changeStatus, delete, edit"
                                    wire:loading.attr="disabled" onclick="Confirm({{ $photo->id }})"
                                    class="btn-dc-circle">
                                    <i class="fas fa-trash "></i>
                                </button>

                                <a class="btn-success-circle outlined" href="{{ $photo->image }}" download>
                                    <i class="fas fa-download"></i>
                                </a>
                            </div>
                        </div>
                    </div>

                </div>

            @empty
                <div class="col-12">
                    <div class="alert alert-info text-center rounded-3 py-3 shadow-sm">
                        <i class="far fa-sad-tear"></i> No se encontraron registros.
                    </div>
                </div>
            @endforelse
        </div>
        <div class="border-top py-3 px-3 d-flex align-items-center">
            {{ $photos->links() }}
        </div>
    </x-card-body>
</div>
