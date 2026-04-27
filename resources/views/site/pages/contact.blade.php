@extends('site.layout')
@section('content')
    <section class="section section-color-1">
        <div class="section-container">
            <div class="section-header">
                <h2 class="section-title">Contáctanos</h2>
                <p class="section-subtitle">
                    Estamos aquí para ayudarte. Envíanos tu consulta o visita nuestras oficinas.
                </p>
            </div>
            <form>
                <div class="form-group">
                    <label for="name">Nombre completo</label>
                    <input type="text" id="name" class="form-control" placeholder="Tu nombre">
                </div>

                <div class="form-group">
                    <label for="email">Correo electrónico</label>
                    <input type="email" id="email" class="form-control" placeholder="Tu email">
                </div>

                <div class="form-group">
                    <label for="subject">Asunto</label>
                    <select id="subject" class="form-control">
                        <option value="">Selecciona un asunto</option>
                        <option value="consulta">Consulta legal</option>
                        <option value="evento">Evento</option>
                        <option value="otro">Otro</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="message">Mensaje</label>
                    <textarea id="message" class="form-control" placeholder="Escribe tu mensaje"></textarea>
                </div>

                <div class="form-group">
                    <input type="checkbox" id="agree">
                    <label for="agree">Acepto los términos y condiciones</label>
                </div>

                <button type="submit" class="btn btn-primary">Enviar</button>
            </form>


            <h1>Example heading <span class="badge text-bg-primary">New</span></h1>
            <h2>Example heading <span class="badge text-bg-primary">New</span></h2>
            <h3>Example heading <span class="badge text-bg-primary">New</span></h3>
            <h4>Example heading <span class="badge text-bg-primary">New</span></h4>
            <h5>Example heading <span class="badge text-bg-primary">New</span></h5>
            <h6>Example heading <span class="badge text-bg-primary">New</span></h6>


            <div class="input-group mb-3">
                <span class="input-group-text" id="basic-addon1">@</span>
                <input type="text" class="form-control" placeholder="Username" aria-label="Username"
                    aria-describedby="basic-addon1">
            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Recipient’s username"
                    aria-label="Recipient’s username" aria-describedby="basic-addon2">
                <span class="input-group-text" id="basic-addon2">@example.com</span>
            </div>

            <div class="mb-3">
                <label for="basic-url" class="form-label">Your vanity URL</label>
                <div class="input-group">
                    <span class="input-group-text" id="basic-addon3">https://example.com/users/</span>
                    <input type="text" class="form-control" id="basic-url" aria-describedby="basic-addon3 basic-addon4">
                </div>
                <div class="form-text" id="basic-addon4">Example help text goes outside the input group.</div>
            </div>

            <div class="input-group mb-3">
                <span class="input-group-text">$</span>
                <input type="text" class="form-control" aria-label="Amount (to the nearest dollar)">
                <span class="input-group-text">.00</span>
            </div>

            <div class="input-group mb-3">
                <input type="text" class="form-control" placeholder="Username" aria-label="Username">
                <span class="input-group-text">@</span>
                <input type="text" class="form-control" placeholder="Server" aria-label="Server">
            </div>

            <div class="input-group">
                <span class="input-group-text">With textarea</span>
                <textarea class="form-control" aria-label="With textarea"></textarea>
            </div>

        </div>
    </section>
@endsection
