@extends('layouts.user')
@section('content')
    <!-- slider -->
    <section class="  md:h-[40vh] h-[25vh] lg:h-[55vh]  relative   bg-red-500">
        <div class="h-full w-full absolute  z-0  "
            style="background-color: transparent;background-image: url({{ asset('assets/Rektorat.webp') }});background-repeat: no-repeat;background-position: left 50%; background-size: cover;">
        </div>
        <div class="h-full w-full absolute  z-0 bg-gradient-to-r from-transparent  to-white  md:block hidden "></div>
        <svg viewBox="0 0 1428 174" version="1.1" class="z-10 absolute bottom-0" xmlns="http://www.w3.org/2000/svg"
            xmlns:xlink="http://www.w3.org/1999/xlink">
            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <g transform="translate(-2.000000, 44.000000)" fill="#fff" fill-rule="nonzero">
                    <path
                        d="M0,0 C90.7283404,0.927527913 147.912752,27.187927 291.910178,59.9119003 C387.908462,81.7278826 543.605069,89.334785 759,82.7326078 C469.336065,156.254352 216.336065,153.6679 0,74.9732496"
                        opacity="0.3"></path>
                    <path
                        d="M100,104.708498 C277.413333,72.2345949 426.147877,52.5246657 546.203633,45.5787101 C666.259389,38.6327546 810.524845,41.7979068 979,55.0741668 C931.069965,56.122511 810.303266,74.8455141 616.699903,111.243176 C423.096539,147.640838 250.863238,145.462612 100,104.708498 Z"
                        opacity="0.4"></path>
                    <path
                        d="M1046,51.6521276 C1130.83045,29.328812 1279.08318,17.607883 1439,40.1656806 L1439,120 C1271.17211,77.9435312 1140.17211,55.1609071 1046,51.6521276 Z"
                        id="Path-4" opacity="0.5"></path>
                </g>
                <g transform="translate(-4.000000, 76.000000)" fill="#fff  " fill-rule="nonzero">
                    <path
                        d="M0.457,34.035 C57.086,53.198 98.208,65.809 123.822,71.865 C181.454,85.495 234.295,90.29 272.033,93.459 C311.355,96.759 396.635,95.801 461.025,91.663 C486.76,90.01 518.727,86.372 556.926,80.752 C595.747,74.596 622.372,70.008 636.799,66.991 C663.913,61.324 712.501,49.503 727.605,46.128 C780.47,34.317 818.839,22.532 856.324,15.904 C922.689,4.169 955.676,2.522 1011.185,0.432 C1060.705,1.477 1097.39,3.129 1121.236,5.387 C1161.703,9.219 1208.621,17.821 1235.4,22.304 C1285.855,30.748 1354.351,47.432 1440.886,72.354 L1441.191,104.352 L1.121,104.031 L0.457,34.035 Z"
                        opacity="1">
                    </path>
                </g>
            </g>
        </svg>
    </section>
    <div class="w-full h-full">
        <div class="flex flex-no-wrap">
            <!-- Sidebar ends -->
            <div class="container mx-auto py-10 block  md:w-4/5 w-11/12 px-6">
                <div class="w-full h-full rounded  ">
                    <section aria-labelledby="products-heading" class="pb-24 pt-6 ">
                        <h2 class="mb-6 text-center font-sans text-2xl lg:text-3xl font-bold text-blue-900 uppercase  "
                            style="text-shadow:5px 5px 5px #38383863;">
                            Layanan Survei UNIVERSITAS BENGKULU</h2>
                        <p class="text-[14px] leading-7 text-center md:px-[20%] mb-10 font-[Poppins]">Silahkan pilih layanan
                            survei
                            yang ingin anda isi, survei ini bertujuan untuk mengetahui kepuasan pengguna terhadap layanan
                            yang
                            diberikan oleh Universitas Bengkulu.
                        </p>
                        <div class="mx-auto grid grid-cols-1 gap-x-1 md:gap-x-8 gap-y-10 lg:grid-cols-3 md:grid-cols-2">
                            <a href="{{ route('dosen-tendik') }}"
                                class="rounded-md bg-blue-900 duration-300 transform content-div md:p-2 p-1 group shadow-lg hover:shadow-xl">
                                <div class="bg-white py-6 px-3 shadow-[inset_0px_0px_10px_0px_#000] rounded-md">
                                    <div
                                        class="relative   items-end overflow-hidden  grid  group-hover:opacity-25 duration-300 transform">
                                        <img class="   rounded-md place-self-center h-16"
                                            src="{{ asset('assets/Logo.svg') }}" alt="Img" />
                                    </div>
                                    <div class=" group-hover:opacity-25 duration-200 transform mt-3 px-2 h-10">
                                        <h2 class="text-gray-800 font-bold text-center line-clamp-2">Survei Kepuasan Dosen
                                            dan Tendik</h2>
                                    </div>
                                    <div
                                        class="absolute  w-full top-0 left-0  text-center  grid  h-full  opacity-0 group-hover:opacity-100  duration-200 transform">
                                        <div class="  text-center   place-self-center  ">
                                            <div
                                                class="text-center px-10 py-3 mx-auto   text-sm bg-blue-600 rounded-lg hover:bg-blue-500 focus:ring focus:ring-orange-300 focus:ring-opacity-80 duration-300 transform text-white font-bold ">
                                                Isi
                                                Survei</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('alumni') }}"
                                class="rounded-md bg-blue-900 duration-300 transform content-div md:p-2 p-1 group shadow-lg hover:shadow-xl">
                                <div class="bg-white py-6 px-3 shadow-[inset_0px_0px_10px_0px_#000] rounded-md">
                                    <div
                                        class="relative   items-end overflow-hidden  grid  group-hover:opacity-25 duration-300 transform">
                                        <img class="   rounded-md place-self-center h-16"
                                            src="{{ asset('assets/Logo.svg') }}" alt="Img" />
                                    </div>
                                    <div class=" group-hover:opacity-25 duration-200 transform mt-3 px-2 h-10">
                                        <h2 class="text-gray-800 font-bold text-center line-clamp-2">Survei Kepuasan
                                            Pengguna Lulusan</h2>
                                    </div>
                                    <div
                                        class="absolute w-full top-0 left-0  text-center  grid  h-full  opacity-0 group-hover:opacity-100  duration-200 transform">
                                        <div class="  text-center   place-self-center  ">
                                            <div href="details.html"
                                                class="text-center px-10 py-3 mx-auto   text-sm bg-blue-600 rounded-lg hover:bg-blue-500 focus:ring focus:ring-orange-300 focus:ring-opacity-80 duration-300 transform text-white font-bold ">
                                                Isi
                                                Survei</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <a href="{{ route('sarana-prasarana') }}"
                                class="rounded-md bg-blue-900 duration-300 transform content-div md:p-2 p-1 group shadow-lg hover:shadow-xl">
                                <div class="bg-white py-6 px-3 shadow-[inset_0px_0px_10px_0px_#000] rounded-md">
                                    <div
                                        class="relative   items-end overflow-hidden  grid  group-hover:opacity-25 duration-300 transform">
                                        <img class="   rounded-md place-self-center h-16"
                                            src="{{ asset('assets/Logo.svg') }}" alt="Img" />
                                    </div>
                                    <div class=" group-hover:opacity-25 duration-200 transform mt-3 px-2 h-10">
                                        <h2 class="text-gray-800 font-bold text-center line-clamp-2">Survei Kepuasan
                                            Pengguna Sarana dan Prasarana UNIB
                                        </h2>
                                    </div>
                                    <div
                                        class="absolute w-full top-0 left-0  text-center  grid  h-full  opacity-0 group-hover:opacity-100  duration-200 transform">
                                        <div class="  text-center   place-self-center  ">
                                            <div
                                                class="text-center px-10 py-3 mx-auto   text-sm bg-blue-600 rounded-lg hover:bg-blue-500 focus:ring focus:ring-orange-300 focus:ring-opacity-80 duration-300 transform text-white font-bold ">
                                                Isi
                                                Survei</div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    </section>


                </div>
            </div>
        </div>
        <div class="grid        ">
            <div class="place-self-center md:flex space-x-2 pb-5">
                <img src="{{ asset('assets/Head-UNIB-3.png') }}" class="lg:h-12 h-9  " alt="UNIB-3.png">
                <img src="{{ asset('assets/acquin.png') }}" class="lg:h-12 h-9 mt-3 md:mt-0 " alt="acquin.png">
            </div>
        </div>
    </div>
@endsection
