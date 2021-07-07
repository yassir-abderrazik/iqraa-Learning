<style>
    .padding {

        color: white;
    }

    .padding-1 {
        padding: 20px;
    }

    .image-bg {
        height: 150px;
        width: 100%;
        background-color: #000000;
        border-bottom: solid 5px #EC2E88;
    }

    .card {
        background-color: #222222;
        height: 300px;
        width: 100%;
    }

    .text {
        font-family: Georgia, serif;
        font-size: 17px;
        letter-spacing: 2px;
        word-spacing: 2px;
        color: #ffff;
        font-weight: 400;
        text-decoration: none;
        font-style: normal;
        font-variant: normal;
        text-transform: none;
    }

    ul {
        list-style-type: square;
        list-style-position: outside;
    }

    li {
        padding: 8px;
        margin: 0px;
    }

</style>
{{-- Valider RDV contenu START --}}

<div class="padding">
    <div class="image-bg">
        <div class="padding-1">

            <h1 style=" font-size: 40px"><strong style="color: #0099FF;">IQRAA</strong>Learning</h1>
        </div>
    </div>
    <div class="card">
        <div class="padding-1">

            <p class="text">
                Bonjour, votre course " {{ $course->title }} " a été validé .
            </p>
            <p class="text">
            <ul>
                <li>Nom du course : {{ $course->title }}</li>
                <li>Niveau : {{ $course->level }}</li>
                <li>Type : {{ $course->type }}</li>
                <li>Prix : {{ $course->price }} $</li>
            </ul>
            </p>
        </div>
    </div>
    <div class="image-bg">
        <div class="padding-1">
            <p class="text">Adresse: Avenue Mohammed V, 40000 Martil, Maroc</p>
            <p class="text">Email: iqraalearning@iqraalearning.com</p>
        </div>
    </div>
</div>
{{-- Valider RDV contenu END --}}
