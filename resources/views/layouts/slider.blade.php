@section('stylesheets-slider')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
@endsection

@section('slider')
<div id="mycarousel" class="carousel slide" data-ride="carousel">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        @for ($i = 0; $i < count($images); $i++)
        <li data-target="#mycarousel" data-slide-to="{{ $i }}"></li>
        @endfor
    </ol>

    <!-- Wrapper for slides -->
    <div class="carousel-inner" role="listbox">
        @foreach( $images as $value)
        <div class="item">
            <img src="<?php echo asset('/images/slider/'.  $value  .'.jpg') ?>" data-color="lightblue" alt="First Image">
        </div>
        @endforeach
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#mycarousel" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Anterior</span>
    </a>
    <a class="right carousel-control" href="#mycarousel" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Posterior</span>
    </a>
</div>
@endsection

@section('scripts-slider')
<script>
    var $item = $('.carousel .item');
    var $wHeight = $(window).height() / 2;
    $item.eq(0).addClass('active');
    $item.height($wHeight);
    //$item.addClass('full-screen');

    $('.carousel img').each(function () {
        var $src = $(this).attr('src');
        var $color = $(this).attr('data-color');
        $(this).parent().css({
            'background-image': 'url(' + $src + ')',
            'background-color': $color
        });
        $(this).remove();
    });

    $(window).on('resize', function () {
        $wHeight = $(window).height();
        $item.height($wHeight);
    });

    $('.carousel').carousel({
        interval: 6000,
        pause: "false"
    });
</script>
@endsection