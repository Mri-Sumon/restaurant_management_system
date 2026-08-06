    <!-- ================ start footer Area ================= -->
    <footer class="footer-area section-gap">
        <div class="container">
            <div class="row mt-4">
                <div class="col-md-4">
                    <hr class="d-md-none" />
                    <p class="store-header py-2">{{ $info->name}}</p>
                    <hr class="d-none d-md-block" />
                    <div class="mt-4">
                        <div  style="text-align: justify;color:white">{!! $about->short_description!!}</div>
                        </div>
                    <!-- <div class="d-flex justify-content-start align-items-start">
                      
                        <div>
                            <p class="store-icon">
                                <i class="ti-location-pin"></i>
                            </p>
                        </div>
                        <div class="pl-3 mt-1">
                            <p>{{ $info->address}}</p>
                        </div>
                    </div> -->

                    <div class="d-flex justify-content-start align-items-start mt-3">
                        <div>
                            <p class="store-icon">
                                <i class="ti-mobile"></i>
                            </p>
                        </div>
                        <div class="pl-3 mt-1">
                          <a href="tel:{{ $info->phone}}"> <p class="store-header">Phone</p>
                            <p>{{ $info->phone}}</p></a> 
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <hr class="d-md-none" />
                    <p class="store-header py-2">Opening Hours</p>
                    <hr class="d-none d-md-block" />
                    <div class="d-flex justify-content-start align-items-start">
                        <div class="pl-3 mt-1">
                            <ul class="list-unstyled">
                                <li><a href="#" class="py-2 d-block" style="color: white !important;">Monday: <span>{{ $info->monday}}</span></a></li>
                                <li><a href="#" class="py-2 d-block" style="color: white !important;">Tuesday: <span>{{ $info->tuesday}}</span></a></li>
                                <li><a href="#" class="py-2 d-block" style="color: white !important;">Wednesday: <span>{{ $info->wednesday}}</span></a></li>
                                <li><a href="#" class="py-2 d-block" style="color: white !important;">Thursday: <span>{{ $info->thursday}}</span></a></li>
                                <li><a href="#" class="py-2 d-block" style="color: white !important;">Friday: <span>{{ $info->friday}}</span></a></li>
                                <li><a href="#" class="py-2 d-block" style="color: white !important;">Saturday: <span>{{ $info->saturday}}</span></a></li>
                                <li><a href="#" class="py-2 d-block" style="color: white !important;">Sunday: <span>{{ $info->sunday}}</span></a></li>
                            </ul>
                        </div>
                    </div>
                </div>


                <div class="col-md-4">
                    <hr class="d-md-none" />
                    <p class="store-header py-2">Contact Information </p>
                    <hr class="d-none d-md-block" />
                    <div class="d-flex justify-content-start align-items-start">
                        <div>
                            <p class="store-icon">
                                <i class="ti-location-pin"></i>
                            </p>
                        </div>
                        <div class="pl-3 mt-1">
                            <p class="store-header">ADDRESS</p>
                            <p>{{ $info->address}}</p>
                        </div>
                    </div>

                    <div class="d-flex justify-content-start align-items-start mt-3">
                        <div>
                            <p class="store-icon">
                                <i class="ti-email"></i>
                            </p>
                        </div>
                        <div class="pl-3 mt-1">
                          <a href="mailto:{{ $info->email}}"> <p class="store-header">Email</p>
                            <p>{{ $info->email}}</p> </a> 
                        </div>

                        
                    </div>
                    <div class="d-flex justify-content-start align-items-start mt-3">
                    <iframe src="{{ $info->map_link}}" width="600" style="border:0;height:200px !important" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"  ></iframe>
                    </div>
                </div>
            </div>
            <div class="text-center footer-bottom row align-items-center text-lg-left">
                <p class="m-0 footer-text col-lg-8 col-md-12">
                    copyright ©2024 All rights reserved <img src="{{asset($info->logo)}}" style="width:120px;height:100px">
                </p>
                <div class="text-center col-lg-4 col-md-12 text-lg-right footer-social">
                    <a href="{{ $info->facebook}}" target="_blank"><i class="ti-facebook"></i></a>
                    <a href="{{ $info->twitter}}" target="_blank"><i class="ti-twitter-alt"></i></a>
                    <a href="{{ $info->instagram}}" target="_blank"><i class="ti-instagram"></i></a>
                    <a href="{{ $info->youtube}}" target="_blank"><i class="ti-youtube"></i></a>
                </div>
            </div>
        </div>

    </footer>
    <!-- ================ End footer Area ================= -->