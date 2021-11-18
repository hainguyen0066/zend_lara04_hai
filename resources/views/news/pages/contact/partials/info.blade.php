<div class="row m-5">
    <div class="col-sm-6 col-lg-4">
        <div class="contact_localtion text-center">
            <div class="icon"><i class="fa fa-map-marker" aria-hidden="true"></i></div>
            <h4>Địa chỉ</h4>
            <p>{{ $info['address'] }}</p></div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="contact_localtion text-center">
            <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
            <h4>Hotline</h4>
            <p class="mb0"> Hotline 1: <a href="tel:090 5744 470">{{ $info['hotline'] }}</a>
        </div>
    </div>
    <div class="col-sm-6 col-lg-4">
        <div class="contact_localtion text-center">
            <div class="icon"><i class="fa fa-phone" aria-hidden="true"></i></div>
            <h4>Email</h4>
            <p class="mb0">{{ $email['email'] }}</p>
        </div>
    </div>

</div>
