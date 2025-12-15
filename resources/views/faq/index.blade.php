<h2>FAQ - Pertanyaan Umum</h2>

@foreach($faqs as $faq)
    <div style="margin-bottom:15px">
        <strong>{{ $faq->question }}</strong>
        <p>{{ $faq->answer }}</p>
    </div>
@endforeach
