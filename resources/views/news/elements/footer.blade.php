@php
    $facebookLink = json_decode($socialInfo['facebook'], true);
    $youtubeLink = json_decode($socialInfo['youtube'], true);
    $googleLink = json_decode($socialInfo['google'], true);
@endphp
<section class="footer_one" style="background-color: #dddddd; color: #000000">
    <div class="container">
        <div class="row justify-content-md-center text-center">
            <div class="comments_form m-auto d-none d-md-block d-lg-none"><a href="tel:0905744470"
                                                                             class="btn btn-thm"><i class="fa fa-phone"
                                                                                                    aria-hidden="true"></i>
                    0905 744 470</a><a href="https://zalo.me/0905744470" rel="noopener" target="_blank"
                                       class="btn btn-thm">Liên hệ Zalo</a><a href="https://zalo.me/0905744470"
                                                                              rel="noopener" target="_blank"
                                                                              class="btn btn-thm">Liên hệ Facebook</a>
            <div class="comments_form social-footer">

            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6 col-lg-5 d-none d-lg-block">
                <div class="footer_contact_widget"><a
                            href="https://online.gov.vn/Home/WebDetails/35388" rel="noopener" target="_blank"><img
                                data-src="https://www.zendvn.com/frontend/assets/images/bo-cong-thuong.png"
                                class="img-fluid mb-3 ls-is-cached lazyloaded" alt="bo-cong-thuong"
                                src="https://www.zendvn.com/frontend/assets/images/bo-cong-thuong.png"></a>
                    <p>Công Ty Cổ Phần Lập Trình Zend Việt Nam - Mã số thuế: 0314390745</p>
                    <p>Tầng 5, Tòa nhà Songdo, 62A Phạm Ngọc Thạch, Phường Võ Thị Sáu, Quận 3, Thành phố Hồ Chí Minh</p>
                    <p>Giấy phép đăng ký kinh doanh số 0314390745 do Sở Kế hoạch và Đầu tư Thành phố Hồ Chí Minh cấp
                        ngày 09/05/2017</p></div>
            </div>
            <div class="col-sm-6 col-lg-3 d-none d-lg-block">
            </div>
            <div class="col-sm-6 col-md-6 col-lg-4 d-none d-lg-block" style="margin-top: 50px">
                <div class="footer_support_widget"><h4>KẾT NỐI ZENDVN</h4>
                    <ul class="list-unstyled">
                        <li style="color: #999ba0;">Mr. Linh: <a href="tel:0336405077">0336 405 077 (Hỗ trợ khóa học
                                Online)</a></li>
                        <li style="color: #999ba0;">Mr. Lân: <a href="tel:0383308983">0383 308 983 (Hỗ trợ khóa học
                                Offline và 1 kèm 1)</a></li>
                        <li style="color: #999ba0;">Ms. Nghi: <a href="tel:0905744470">090 5744 470 (Hỗ trợ ghi danh và
                                tài khoản học viên)</a></li>
                        <li style="color: #999ba0;">Email: <a href="mailto:training@zendvn.com">training@zendvn.com</a>
                        </li>
                        <li><a class="text-white" href="https://www.zendvn.com/lien-he">Liên hệ</a></li>
                        <li><a class="text-white" href="https://www.zendvn.com/bai-viet/chinh-sach-bao-mat-9">Chính sách
                                bảo mật</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<footer class="footer">
    <div class="footer_social">
        <div class="container">
            <div class="row">
                <div class="col text-center">
                    <ul class="footer_social_list d-flex flex-row align-items-center justify-content-center">
                        <li><a  target="_blank" href="{{ $facebookLink[0]['value'] }}"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" href="{{ $youtubeLink[0]['value'] }}"><i class="fa fa-google" aria-hidden="true"></i></a></li>
                        <li><a target="_blank" href="{{ $googleLink[0]['value'] }}"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
