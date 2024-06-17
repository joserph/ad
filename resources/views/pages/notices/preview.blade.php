@extends('layouts.app')

@section('styles')
@endsection

@section('content')
    <div class="card bg-info-subtle shadow-none position-relative overflow-hidden mb-4" bis_skin_checked="1">
        <div class="card-body px-4 py-3" bis_skin_checked="1">
        <div class="row align-items-center" bis_skin_checked="1">
            <div class="col-9" bis_skin_checked="1">
            <h4 class="fw-semibold mb-8">Noticias</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a class="text-muted text-decoration-none" href="{{ route('notices.home') }}">Inicio</a>
                </li>
                <li class="breadcrumb-item" aria-current="page">Noticias</li>
                </ol>
            </nav>
            </div>
            <div class="col-3" bis_skin_checked="1">
            <div class="text-center mb-n5" bis_skin_checked="1">
                <img src="{{ asset('assets/images/notices/ChatBc.png') }}" alt="" class="img-fluid mb-n4">
            </div>
            </div>
        </div>
        </div>
    </div>

    <div class="row" bis_skin_checked="1">

        @if (count($notices) > 0)

            @foreach ($mainArticles as $key => $notice)
                <div class="col-md-6 {{ (count($mainArticles) == 1) ? 'col-lg-12' : (($key == 0) ? 'col-lg-8' : 'col-lg-4') }}">

                    @if(isset($notice->noticeFiles) && count($notice->noticeFiles) > 0)
                        <div class="card blog blog-img-one position-relative overflow-hidden hover-img" bis_skin_checked="1" style="background-image: url({{ asset($notice->noticeFiles[0]->file_path) }});">
                    @else
                        <div class="card blog blog-img-one position-relative overflow-hidden hover-img" bis_skin_checked="1" style="background-image: url({{ asset('assets/images/blog.jpg') }});">
                    @endif
                        <div class="card-body position-relative" bis_skin_checked="1">
                            <div class="d-flex flex-column justify-content-between h-100" bis_skin_checked="1">
                                <div class="d-flex align-items-start justify-content-between" bis_skin_checked="1">
                                    <div class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
                                        data-bs-title="Mollie Underwood" bis_skin_checked="1">
                                        <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt=""
                                            class="rounded-circle img-fluid" width="40" height="40">
                                    </div>
                                    <span class="badge text-bg-primary rounded-3 fs-2 fw-semibold">{{ $notice->category->name }}</span>
                                </div>
                                <div bis_skin_checked="1">
                                    <a href="{{ route('notices.detail', $notice) }}"
                                        class="fs-7 my-4 fw-semibold text-white d-block lh-sm">{{$notice->title}}</a>
                                    <div class="d-flex align-items-center gap-4" bis_skin_checked="1">
                                        <div class="d-none align-items-center gap-2 text-white fs-3 fw-normal"
                                            bis_skin_checked="1">
                                            <i class="ti ti-eye fs-5"></i>
                                            6006
                                        </div>
                                        <div class="d-none align-items-center gap-2 text-white fs-3 fw-normal"
                                            bis_skin_checked="1">
                                            <i class="ti ti-message-2 fs-5"></i>
                                            3
                                        </div>
                                        <div class="d-flex align-items-center gap-1 text-white fw-normal ms-auto"
                                            bis_skin_checked="1">
                                            <i class="ti ti-point"></i>
                                            <small>{{ $notice->created_at->format('D, M j') }}</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

            @foreach ($subArticles as $notice)
                <div class="col-md-6 col-lg-4" bis_skin_checked="1">
                    <div class="card rounded-2 overflow-hidden hover-img" bis_skin_checked="1">
                        <div class="position-relative" bis_skin_checked="1">
                            <a href="{{ route('notices.detail', $notice) }}">
                                @if(isset($notice->noticeFiles) && count($notice->noticeFiles) > 0)
                                    <img src="{{ asset($notice->noticeFiles[0]->file_path) }}" class="card-img-top rounded-0" alt="...">
                                @else
                                    <img src="{{ asset('assets/images/blog.jpg') }}" class="card-img-top rounded-0" alt="...">
                                @endif
                            </a>
                            <span
                                class="d-none badge text-bg-light fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                                min Read</span>
                            <img src="{{ asset('assets/images/profile/user-1.jpg') }}" alt=""
                                class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9"
                                width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top"
                                data-bs-title="Esther Lindsey">
                        </div>
                        <div class="card-body p-4" bis_skin_checked="1">
                            <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm  mt-3">{{ $notice->category->name }}</span>
                            <a class="d-block my-4 fs-5 text-dark fw-semibold"
                                href="{{ route('notices.detail', $notice) }}">{{ $notice->title }}</a>
                            <div class="d-flex align-items-center gap-4" bis_skin_checked="1">
                                <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                        class="ti ti-eye text-dark fs-5"></i>2252</div>
                                <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                        class="ti ti-message-2 text-dark fs-5"></i>3</div>
                                <div class="d-flex align-items-center fs-2 ms-auto" bis_skin_checked="1"><i
                                        class="ti ti-point text-dark"></i>{{ $notice->created_at->format('D, M j') }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach

        @else

            <div class="col-md-6 col-lg-8" bis_skin_checked="1">
                <div class="card blog blog-img-one position-relative overflow-hidden hover-img" bis_skin_checked="1" style="background-image: url({{ asset('assets/images/notices/notice1.jpg') }});">
                    <div class="card-body position-relative" bis_skin_checked="1">
                        <div class="d-flex flex-column justify-content-between h-100" bis_skin_checked="1">
                            <div class="d-flex align-items-start justify-content-between" bis_skin_checked="1">
                                <div class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Mollie Underwood" bis_skin_checked="1">
                                    <img src="../assets/images/profile/user-1.jpg" alt=""
                                        class="rounded-circle img-fluid" width="40" height="40">
                                </div>
                                <span class="badge text-bg-primary rounded-3 fs-2 fw-semibold">Gadget</span>
                            </div>
                            <div bis_skin_checked="1">
                                <a href="#"
                                    class="fs-7 my-4 fw-semibold text-white d-block lh-sm">Early Black Friday
                                    Amazon deals: cheap TVs, headphones, laptops</a>
                                <div class="d-flex align-items-center gap-4" bis_skin_checked="1">
                                    <div class="d-none align-items-center gap-2 text-white fs-3 fw-normal"
                                        bis_skin_checked="1">
                                        <i class="ti ti-eye fs-5"></i>
                                        6006
                                    </div>
                                    <div class="d-none align-items-center gap-2 text-white fs-3 fw-normal"
                                        bis_skin_checked="1">
                                        <i class="ti ti-message-2 fs-5"></i>
                                        3
                                    </div>
                                    <div class="d-flex align-items-center gap-1 text-white fw-normal ms-auto"
                                        bis_skin_checked="1">
                                        <i class="ti ti-point"></i>
                                        <small>Fri, Jan 13</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" bis_skin_checked="1">
                <div class="card blog blog-img-two position-relative overflow-hidden hover-img"
                    bis_skin_checked="1" style="background-image: url({{ asset('assets/images/notices/notice2.jpg') }});">
                    <div class="card-body position-relative" bis_skin_checked="1">
                        <div class="d-flex flex-column justify-content-between h-100" bis_skin_checked="1">
                            <div class="d-flex align-items-start justify-content-between" bis_skin_checked="1">
                                <div class="position-relative" data-bs-toggle="tooltip" data-bs-placement="top"
                                    data-bs-title="Francisco Quinn" bis_skin_checked="1">
                                    <img src="../assets/images/profile/user-1.jpg" alt=""
                                        class="rounded-circle img-fluid" width="40" height="40">
                                </div>
                                <span class="badge text-bg-primary rounded-3 fs-2 fw-semibold">Health</span>
                            </div>
                            <div bis_skin_checked="1">
                                <a href="#"
                                    class="fs-7 my-4 fw-semibold text-white d-block lh-sm">Presented by Max
                                    Rushden with Barry Glendenning, Philippe Auclair</a>
                                <div class="d-flex align-items-center gap-4" bis_skin_checked="1">
                                    <div class="d-none align-items-center gap-2 text-white fs-3 fw-normal"
                                        bis_skin_checked="1">
                                        <i class="ti ti-eye fs-5"></i>
                                        713
                                    </div>
                                    <div class="d-none align-items-center gap-2 text-white fs-3 fw-normal"
                                        bis_skin_checked="1">
                                        <i class="ti ti-message-2 fs-5"></i>
                                        3
                                    </div>
                                    <div class="d-flex align-items-center gap-1 text-white fw-normal ms-auto"
                                        bis_skin_checked="1">
                                        <i class="ti ti-point"></i>
                                        <small>Wed, Jan 18</small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" bis_skin_checked="1">
                <div class="card rounded-2 overflow-hidden hover-img" bis_skin_checked="1">
                    <div class="position-relative" bis_skin_checked="1">
                        <a href="#"><img src="{{ asset('assets/images/notices/notice3.avif') }}"
                                class="card-img-top rounded-0" alt="..."></a>
                        <span
                            class="d-none badge text-bg-light fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                            min Read</span>
                        <img src="../assets/images/profile/user-1.jpg" alt=""
                            class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9"
                            width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Addie Keller">
                    </div>
                    <div class="card-body p-4" bis_skin_checked="1">
                        <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm  mt-3">Gadget</span>
                        <a class="d-block my-4 fs-5 text-dark fw-semibold" href="#">As yen
                            tumbles, gadget-loving Japan goes
                            for iPhones</a>
                        <div class="d-flex align-items-center gap-4" bis_skin_checked="1">
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-eye text-dark fs-5"></i>9,125</div>
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-message-2 text-dark fs-5"></i>3</div>
                            <div class="d-flex align-items-center fs-2 ms-auto" bis_skin_checked="1"><i
                                    class="ti ti-point text-dark"></i>Mon, Jan 16
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" bis_skin_checked="1">
                <div class="card rounded-2 overflow-hidden hover-img" bis_skin_checked="1">
                    <div class="position-relative" bis_skin_checked="1">
                        <a href="#"><img src="{{ asset('assets/images/notices/notice4.jpg') }}"
                                class="card-img-top rounded-0" alt="..."></a>
                        <span
                            class="d-none badge text-bg-light fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                            min Read</span>
                        <img src="../assets/images/profile/user-1.jpg" alt=""
                            class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9"
                            width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Walter Palmer">
                    </div>
                    <div class="card-body p-4" bis_skin_checked="1">
                        <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm  mt-3">Social</span>
                        <a class="d-block my-4 fs-5 text-dark fw-semibold" href="#">Intel
                            loses
                            bid to revive antitrust case
                            against patent foe Fortress</a>
                        <div class="d-flex align-items-center gap-4" bis_skin_checked="1">
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-eye text-dark fs-5"></i>4,150</div>
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-message-2 text-dark fs-5"></i>38</div>
                            <div class="d-flex align-items-center fs-2 ms-auto" bis_skin_checked="1"><i
                                    class="ti ti-point text-dark"></i>Sun, Jan 15
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" bis_skin_checked="1">
                <div class="card rounded-2 overflow-hidden hover-img" bis_skin_checked="1">
                    <div class="position-relative" bis_skin_checked="1">
                        <a href="#"><img src="{{ asset('assets/images/notices/notice5.jpg') }}"
                                class="card-img-top rounded-0" alt="..."></a>
                        <span
                            class="d-none badge text-bg-light fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                            min Read</span>
                        <img src="../assets/images/profile/user-1.jpg" alt=""
                            class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9"
                            width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Miguel Kennedy">
                    </div>
                    <div class="card-body p-4" bis_skin_checked="1">
                        <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm  mt-3">Health</span>
                        <a class="d-block my-4 fs-5 text-dark fw-semibold" href="#">COVID
                            outbreak deepens as more lockdowns
                            loom in China</a>
                        <div class="d-flex align-items-center gap-4" bis_skin_checked="1">
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-eye text-dark fs-5"></i>9,480</div>
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-message-2 text-dark fs-5"></i>12</div>
                            <div class="d-flex align-items-center fs-2 ms-auto" bis_skin_checked="1"><i
                                    class="ti ti-point text-dark"></i>Sat, Jan 14
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" bis_skin_checked="1">
                <div class="card rounded-2 overflow-hidden hover-img" bis_skin_checked="1">
                    <div class="position-relative" bis_skin_checked="1">
                        <a href="#"><img src="{{ asset('assets/images/notices/notice6.jpg') }}"
                                class="card-img-top rounded-0" alt="..."></a>
                        <span
                            class="d-none badge text-bg-light fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                            min Read</span>
                        <img src="../assets/images/profile/user-1.jpg" alt=""
                            class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9"
                            width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Esther Lindsey">
                    </div>
                    <div class="card-body p-4" bis_skin_checked="1">
                        <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm  mt-3">Lifestyle</span>
                        <a class="d-block my-4 fs-5 text-dark fw-semibold"
                            href="#">Streaming
                            video way before it was cool, go
                            dark tomorrow</a>
                        <div class="d-flex align-items-center gap-4" bis_skin_checked="1">
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-eye text-dark fs-5"></i>2252</div>
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-message-2 text-dark fs-5"></i>3</div>
                            <div class="d-flex align-items-center fs-2 ms-auto" bis_skin_checked="1"><i
                                    class="ti ti-point text-dark"></i>Sat, Jan 14
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" bis_skin_checked="1">
                <div class="card rounded-2 overflow-hidden hover-img" bis_skin_checked="1">
                    <div class="position-relative" bis_skin_checked="1">
                        <a href="#"><img src="{{ asset('assets/images/notices/notice7.jpg') }}"
                                class="card-img-top rounded-0" alt="..."></a>
                        <span
                            class="d-none badge text-bg-light fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                            min Read</span>
                        <img src="../assets/images/profile/user-1.jpg" alt=""
                            class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9"
                            width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Leroy Greer">
                    </div>
                    <div class="card-body p-4" bis_skin_checked="1">
                        <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm  mt-3">Design</span>
                        <a class="d-block my-4 fs-5 text-dark fw-semibold" href="#">Apple
                            is
                            apparently working on a new
                            ‘streamlined’ accessibility</a>
                        <div class="d-flex align-items-center gap-4" bis_skin_checked="1">
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-eye text-dark fs-5"></i>5860</div>
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-message-2 text-dark fs-5"></i>38</div>
                            <div class="d-flex align-items-center fs-2 ms-auto" bis_skin_checked="1"><i
                                    class="ti ti-point text-dark"></i>Fri, Jan 13
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" bis_skin_checked="1">
                <div class="card rounded-2 overflow-hidden hover-img" bis_skin_checked="1">
                    <div class="position-relative" bis_skin_checked="1">
                        <a href="#"><img src="{{ asset('assets/images/notices/notice8.jpg') }}"
                                class="card-img-top rounded-0" alt="..."></a>
                        <span
                            class="d-none badge text-bg-light fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                            min Read</span>
                        <img src="../assets/images/profile/user-1.jpg" alt=""
                            class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9"
                            width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Tommy Butler">
                    </div>
                    <div class="card-body p-4" bis_skin_checked="1">
                        <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm  mt-3">Lifestyle</span>
                        <a class="d-block my-4 fs-5 text-dark fw-semibold" href="#">After
                            Twitter Staff Cuts, Survivors Face
                            ‘Radio Silence</a>
                        <div class="d-flex align-items-center gap-4" bis_skin_checked="1">
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-eye text-dark fs-5"></i>6315</div>
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-message-2 text-dark fs-5"></i>12</div>
                            <div class="d-flex align-items-center fs-2 ms-auto" bis_skin_checked="1"><i
                                    class="ti ti-point text-dark"></i>Wed, Jan 11
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" bis_skin_checked="1">
                <div class="card rounded-2 overflow-hidden hover-img" bis_skin_checked="1">
                    <div class="position-relative" bis_skin_checked="1">
                        <a href="#"><img src="{{ asset('assets/images/notices/notice9.jpg') }}"
                                class="card-img-top rounded-0" alt="..."></a>
                        <span
                            class="d-none badge text-bg-light fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                            min Read</span>
                        <img src="../assets/images/profile/user-1.jpg" alt=""
                            class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9"
                            width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Donald Holmes">
                    </div>
                    <div class="card-body p-4" bis_skin_checked="1">
                        <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm  mt-3">Design</span>
                        <a class="d-block my-4 fs-5 text-dark fw-semibold" href="#">Why
                            Figma is
                            selling to Adobe for $20
                            billion</a>
                        <div class="d-flex align-items-center gap-4" bis_skin_checked="1">
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-eye text-dark fs-5"></i>7570</div>
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-message-2 text-dark fs-5"></i>38</div>
                            <div class="d-flex align-items-center fs-2 ms-auto" bis_skin_checked="1"><i
                                    class="ti ti-point text-dark"></i>Wed, Jan 11
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-4" bis_skin_checked="1">
                <div class="card rounded-2 overflow-hidden hover-img" bis_skin_checked="1">
                    <div class="position-relative" bis_skin_checked="1">
                        <a href="#"><img src="{{ asset('assets/images/notices/notice10.jpg') }}"
                                class="card-img-top rounded-0" alt="..."></a>
                        <span
                            class="d-none badge text-bg-light fs-2 rounded-4 lh-sm mb-9 me-9 py-1 px-2 fw-semibold position-absolute bottom-0 end-0">2
                            min Read</span>
                        <img src="../assets/images/profile/user-1.jpg" alt=""
                            class="img-fluid rounded-circle position-absolute bottom-0 start-0 mb-n9 ms-9"
                            width="40" height="40" data-bs-toggle="tooltip" data-bs-placement="top"
                            data-bs-title="Eric Douglas">
                    </div>
                    <div class="card-body p-4" bis_skin_checked="1">
                        <span class="badge text-bg-light fs-2 rounded-4 py-1 px-2 lh-sm  mt-3">Gadget</span>
                        <a class="d-block my-4 fs-5 text-dark fw-semibold" href="#">Garmins
                            Instinct Crossover is a rugged
                            hybrid smartwatch</a>
                        <div class="d-flex align-items-center gap-4" bis_skin_checked="1">
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-eye text-dark fs-5"></i>6763</div>
                            <div class="d-none align-items-center gap-2" bis_skin_checked="1"><i
                                    class="ti ti-message-2 text-dark fs-5"></i>12</div>
                            <div class="d-flex align-items-center fs-2 ms-auto" bis_skin_checked="1"><i
                                    class="ti ti-point text-dark"></i>Tue, Jan 10
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @endif

    </div>
@endsection

@section('page-scripts')
@endsection
