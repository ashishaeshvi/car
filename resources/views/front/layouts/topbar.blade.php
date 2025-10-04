
 <header id="header">
        <nav class="navbar navbar-expand-lg">
            <div class="container">
                <div class="nav-inside d-flex align-items-center justify-content-between">
                    <a class="navbar-brand" href="#"><img src="{{ asset('front-assets/images/logo.png')}}" alt="" /></a>
                    <button class="navbar-toggler collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav" aria-controls="mainNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="mainNav">
                        <div class="navbar-inside mx-auto">
                            <ul class="navbar-nav">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#!" id="newCar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">New Cars</a>
                                    <ul class="dropdown-menu has-mega-menu" aria-labelledby="newCar">
                                        <li><a class="dropdown-item" href="#!">Mahindra</a></li>
                                        <li><a class="dropdown-item" href="#!">Tata</a></li>
                                        <li><a class="dropdown-item" href="#!">Dropdown 3</a></li>
                                        <li><a class="dropdown-item" href="#!">Dropdown 4</a></li>
                                        <li><a class="dropdown-item" href="#!">Dropdown 5</a></li>
                                        <li><a class="dropdown-item" href="#!">Dropdown 6</a></li>
                                        <li><a class="dropdown-item" href="#!">Dropdown 7</a></li>
                                        <li><a class="dropdown-item" href="#!">Dropdown 8</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#!" id="usedCar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Used Cars</a>
                                    <ul class="dropdown-menu has-mega-menu" aria-labelledby="usedCar">
                                        <li><a class="dropdown-item" href="#!">Mahindra</a></li>
                                        <li><a class="dropdown-item" href="#!">Tata</a></li>
                                        <li><a class="dropdown-item" href="#!">Dropdown 3</a></li>
                                        <li><a class="dropdown-item" href="#!">Dropdown 4</a></li>
                                        <li><a class="dropdown-item" href="#!">Dropdown 5</a></li>
                                        <li><a class="dropdown-item" href="#!">Dropdown 6</a></li>
                                        <li><a class="dropdown-item" href="#!">Dropdown 7</a></li>
                                        <li><a class="dropdown-item" href="#!">Dropdown 8</a></li>
                                    </ul>
                                </li>
                                <li class="nav-item"><a class="nav-link" href="#!">Reviews & News</a></li>
                                <li class="nav-item"><a class='nav-link' href="{{ route('news.index') }}">News</a></li>
                                <li class="nav-item"><a class='nav-link' href='/about'>About</a></li>
                            </ul>
                            <!-- <div class="nav-inside-content d-block d-md-none text-center">
                                <a href="#" class="btn btn-default header-btn">Contact</a>
                            </div> -->
                        </div>
                    </div>
                    <div class="header-right d-flex gap-2 g-md-4 align-items-center">
                        <!-- <div class="header-search-bar">
                            <input type="text" class="form-control" placeholder="Search here..">
                            <button class="serach-btn"><i class="fas fa-search"></i></button>
                        </div> -->
                        <a href="#!" class="header-right-map" data-bs-toggle="modal" data-bs-target="#selectcity">
                            <svg stroke="currentColor" fill="currentColor" stroke-width="0" viewBox="0 0 1024 1024" height="18px" width="18px" xmlns="http://www.w3.org/2000/svg">
                                <path d="M515.664-.368C305.76-.368 128 178.4 128 390.176c0 221.76 206.032 448.544 344.624 607.936.528.64 22.929 25.52 50.528 25.52h2.449c27.6 0 49.84-24.88 50.399-25.52 130.064-149.52 320-396.048 320-607.936C896 178.4 757.344-.368 515.664-.368zm12.832 955.552c-1.12 1.12-2.753 2.369-4.193 3.409-1.472-1.008-3.072-2.288-4.255-3.408l-16.737-19.248C371.92 785.2 192 578.785 192 390.176c0-177.008 148.224-326.56 323.664-326.56 218.528 0 316.336 164 316.336 326.56 0 143.184-102.128 333.296-303.504 565.008zm-15.377-761.776c-106.032 0-192 85.968-192 192s85.968 192 192 192 192-85.968 192-192-85.968-192-192-192zm0 320c-70.576 0-129.473-58.816-129.473-129.408 0-70.576 57.424-128 128-128 70.624 0 128 57.424 128 128 .032 70.592-55.903 129.408-126.527 129.408z">
                                </path>
                            </svg>
                        </a>
                        <a href="#!" class="header-right-btn login" data-bs-toggle="modal" data-bs-target="#loginModal">
                            <!-- <span>
                                    <svg stroke="currentColor" fill="currentColor" stroke-width="0"
                                        viewBox="0 0 448 512" height="18px" width="18px"
                                        xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M304 128a80 80 0 1 0 -160 0 80 80 0 1 0 160 0zM96 128a128 128 0 1 1 256 0A128 128 0 1 1 96 128zM49.3 464l349.5 0c-8.9-63.3-63.3-112-129-112l-91.4 0c-65.7 0-120.1 48.7-129 112zM0 482.3C0 383.8 79.8 304 178.3 304l91.4 0C368.2 304 448 383.8 448 482.3c0 16.4-13.3 29.7-29.7 29.7L29.7 512C13.3 512 0 498.7 0 482.3z">
                                        </path>
                                    </svg>
                                </span> -->
                            Login
                        </a>
                       <!--  <a href="#!" class="header-right-btn" data-bs-toggle="modal" data-bs-target="#registerModal">
                            Registration
                        </a> -->
                    </div>
                </div>
            </div>
        </nav>
    </header>









@yield('stylesheet')