@extends('layouts.user')
@section('back')
    <div class="hidden md:block">
        <a href="/"
            class="px-4 py-2 bg-red-500 hover:bg-red-700 transform duration-200   rounded-md text-sm text-white inline-block  ">
            <div class="flex">
                <svg class="w-5 h-5" fill="currentColor" class="bi bi-arrow-left-short" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M12 8a.5.5 0 0 1-.5.5H5.707l2.147 2.146a.5.5 0 0 1-.708.708l-3-3a.5.5 0 0 1 0-.708l3-3a.5.5 0 1 1 .708.708L5.707 7.5H11.5a.5.5 0 0 1 .5.5z" />
                </svg> <span>Kembali</span>
            </div>
        </a>
    </div>
@endsection
@section('content')
    <div class="  bg-blue-900 relative">
        <img src="{{ asset('assets/images/business-background-16.png') }}" alt="bg-img"
            class="w-full h-full object-cover    brightness-50 absolute z-0" />
        <section aria-labelledby="products-heading" class="pb-32 p-6  z-10 relative">
            <div class="grid">
                <img class=" place-self-center    h-20" src="{{ asset('assets/Logo.svg') }}" alt="Img" />
            </div>
            <h2 class="mb-6 mt-4 text-center font-sans text-xl lg:text-3xl font-bold text-white uppercase  ">
                {{ $categories->nama_category }}<br>
                Universitas Bengkulu Tahun
                <script>
                    document.write(new Date().getFullYear())
                </script>
            </h2>

        </section>
    </div>
    <section class="  pattren  pb-8  text-gray-600  body-font  duration-300 transform    ">
        <div class="  h-[15vh]"></div>
        <div class="px-2 -mt-48 relative">
            <div
                class="container     mx-auto bg-white  duration-300 transform    lg:w-11/12     lg:px-12 md:px-8 px-4 py-3 rounded-lg   shadow-[0px_30px_20px_0px_#333] ">
                <div class="col-md-12" style="margin-bottom: 10px;">
                    @if ($message = Session::get('error'))
                        <div class="alert alert-danger alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Gagal :</strong>{{ $message }}
                        </div>
                    @elseif ($message2 = Session::get('success'))
                        <div class="alert alert-success alert-block">
                            <button type="button" class="close" data-dismiss="alert">×</button>
                            <strong>Gagal :</strong>{{ $message2 }}
                        </div>
                    @endif
                </div>
                @if (count($indikators) == 0)
                    <div class="  py-20 text-center     mx-4 sm:mx-6 lg:mx-8">
                        <svg xmlns="http://www.w3.org/2000/svg"
                            class="w-28 md:w-40 mx-auto h-28 md:h-40 text-center fill-gray-400 dark:fill-gray-400 mb-7"
                            fill="currentColor" class="bi bi-exclamation-circle" viewBox="0 0 16 16">
                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14zm0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16z" />
                            <path
                                d="M7.002 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0zM7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 4.995z" />
                        </svg>
                        <h2 class="dark:text-gray-300 text-gray-700 text-lg capitalize"><strong><i
                                    class="fa fa-info-circle"></i>&nbsp;Informasi: </strong> belum ada indikator evaluasi
                            yang ditambahkan! <strong>
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>
                            </strong>!</h2>

                    </div>
                @else
                    <div class=" w-full mt-6 main-question mb-8 flex flex-col divide-y text-gray-800  text-base">
                        <form action="{{ route($categories->slug . '.post') }}" method="post">
                            @csrf
                            <input type="hidden" name="jumlah" value="{{ count($indikators) }}">
                            <input type="hidden" name="category_id" value="{{ $categories->id }}">
                            <div
                                class="relative    pt-3   bg-gradient-to-r from-blue-800 to-[#0F236A] rounded-xl w-full my-5 shadow-lg shadow-gray-500 mb-8 group  ">

                                <div class="mt-6 px-6 py-4   w-full">
                                    <div class="  -mt-6 lg:px-6      grid grid-cols-1  ">
                                        @foreach ($formulir as $form)
                                            @if ($form->type == 'select')
                                                <div class="mb-3   ">

                                                    <label for="{{ $form->variable }}"
                                                        class=" {{ $form->required == 1 ? "after:content-['*'] after:text-red-500" : '' }}  font-semibold  text-white  after:ml-2 text-sm pb-1">{{ $form->label }}</label>
                                                    <select id="{{ $form->variable }}" name="{{ $form->variable }}"
                                                        class="   w-full rounded-lg border-2  border-white
                                                    bg-white px-3 py-2.5 text-sm font-normal transition-all duration-500   focus:border-white
                                                    focus:ring-white
                                                    focus:shadow-[-4px_4px_10px_0px_#000]  "
                                                        {{ $form->required == 1 ? 'required' : '' }}>
                                                        <option value="" disabled selected>--- Pilih {{ $form->label }}  --- </option>
                                                        @foreach (explode(';', $form->additional) as $option)
                                                            <option value="{{ $option }}">{{ $option }}
                                                            </option>
                                                        @endforeach

                                                    </select>
                                                    @if ($errors->has($form->variable))
                                                        <p class="text-red-500 text-sm font-bold">
                                                            {{ $errors->first($form->variable) }}</p>
                                                    @endif
                                                </div>
                                            @elseif ($form->type == 'radio')
                                                <div class="mb-3">
                                                    <label for="{{ $form->variable }}"
                                                        class="{{ $form->required == 1 ? "after:content-['*'] after:text-red-500" : '' }} font-semibold text-white after:ml-2 text-sm pb-1">{{ $form->label }}</label>
                                                    <div class="bg-white rounded-md p-4">
                                                        @foreach (explode(';', $form->additional) as $option)
                                                            <div class="flex items-center mb-2">
                                                                <input type="radio"
                                                                    id="{{ $form->variable }}_{{ $option }}_{{ $form->id }}"
                                                                    name="{{ $form->variable }}"
                                                                    value="{{ $option }}"
                                                                    {{ $form->required == 1 ? 'required' : '' }}
                                                                    class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                                                                <label
                                                                    for="{{ $form->variable }}_{{ $option }}_{{ $form->id }}"
                                                                    class="ml-2 text-sm font-medium text-black">{{ $option }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                    @if ($errors->has($form->variable))
                                                        <p class="text-red-500 text-sm font-bold">
                                                            {{ $errors->first($form->variable) }}</p>
                                                    @endif
                                                </div>
                                            @elseif ($form->type == 'checkbox')
                                                <label for="{{ $form->variable }}"
                                                    class="{{ $form->required == 1 ? "after:content-['*'] after:text-red-500" : '' }} font-semibold text-white after:ml-2 text-sm pb-1">{{ $form->label }}</label>
                                                <div class="bg-white rounded-md p-4">
                                                    @foreach (explode(';', $form->additional) as $option)
                                                        <div class="flex items-center mb-2">
                                                            <input type="checkbox"
                                                                id="{{ $form->variable }}_{{ $option }}"
                                                                name="{{ $form->variable }}[]" value="{{ $option }}"
                                                                class="h-4 w-4 border-gray-300 focus:ring-2 focus:ring-blue-300">
                                                            <label
                                                                for="{{ $form->variable }}_{{ $option }}"
                                                                class="ml-2 text-sm font-medium text-black">{{ $option }} </label>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @else
                                                <div class="mb-3   ">

                                                    <label for="{{ $form->variable }}"
                                                        class=" {{ $form->required == 1 ? "after:content-['*'] after:text-red-500" : '' }}  font-semibold  text-white  after:ml-2 text-sm pb-1">{{ $form->label }}</label>
                                                    <input type="{{ $form->type }}" id="{{ $form->variable }}"
                                                        name="{{ $form->variable }}"
                                                        class="   w-full rounded-lg border-2  border-white
                                                    bg-white px-3 py-2.5 text-sm font-normal transition-all duration-500   focus:border-white
                                                    focus:ring-white
                                                    focus:shadow-[-4px_4px_10px_0px_#000]  "
                                                        placeholder="Masukan {{ $form->label }}"
                                                        {{ $form->required == 1 ? 'required' : '' }} />
                                                    @if ($errors->has($form->variable))
                                                        <p class="text-red-500 text-sm font-bold">
                                                            {{ $errors->first($form->variable) }}</p>
                                                    @endif
                                                </div>
                                            @endif
                                        @endforeach

                                        {{-- <div class="mb-3">
                                            <label for="pekerjaan"
                                                class=" after:content-['*'] after:text-red-500 font-semibold  text-white  after:ml-2 text-sm pb-1">Pekerjaan</label>
                                            <select name="pekerjaan"
                                                class="   w-full rounded-lg border-2  border-white
                                                bg-white px-3 py-2.5 text-sm font-normal transition-all duration-500  focus:border-white
                                                focus:ring-white focus:shadow-[-4px_4px_10px_0px_#000] " required>
                                                <option disabled selected>-- pilih pekerjaan--</option>
                                                <option value="Dosen">Dosen</option>
                                                <option value="Tenaga Kependidikan">Tenaga Kependidikan</option>
                                            </select>
                                            @if ($errors->has('pekerjaan'))
                                                <p class="text-red-500 text-sm font-bold">{{ $errors->first('pekerjaan') }}</p>
                                            @endif
                                        </div> --}}


                                    </div>
                                </div>
                            </div>

                            <div
                                class="relative    pt-3 mt-16 border-2 border-blue-800 rounded-xl w-full my-5   mb-8 group  ">
                                <div>
                                    <div
                                        class=" text-white   bg-blue-800  inline-block    items-center relative rounded-xl     p-4     transform duration-500 ease-in   left-4 -top-10 lg:text-xl text-sm font-sans font-extrabold">
                                        CATATAN!
                                    </div>
                                </div>
                                <div class="  lg:px-6 py-4 -mt-5  ">
                                    <div class="  -mt-6 px-6 ">


                                        <p class="text-sm    "> {{ $categories->nama_category }} Universitas
                                            Bengkulu (UNIB).
                                            Beri penilaian terhadap item-item penilaian di bawah ini dengan cara memilih
                                            salah
                                            satu opsi pada
                                            kolom
                                            Persepsi.</p>
                                        <p class="text-lg font-extrabold   ">Kriteria Penilaian</p>

                                        <ul class=" list-disc    ml-10 text-left   text-sm ">
                                            <li><strong>Sangat Baik</strong> = Nilai 5</li>
                                            <li><strong>Baik</strong> = Nilai 4</li>
                                            <li><strong>Cukup</strong> = Nilai 3</li>
                                            <li><strong>Kurang</strong> = Nilai 2</li>
                                            <li><strong>Sangat Kurang</strong> = Nilai 1</li>
                                        </ul>
                                        <p class="text-sm    ">Atas kesediaan semua responden yang telah
                                            berpartisipasi dalam pengisian kuesioner ini kami
                                            ucapkan terima kasih.</p>
                                    </div>
                                </div>
                            </div>

                            <div
                                class="relative    pt-3 mt-16 border-2 border-blue-800 rounded-xl w-full my-5   mb-8 group  ">
                                <div>
                                    <div
                                        class=" text-white   bg-blue-800  inline-block    items-center relative rounded-xl     p-4      transform duration-500 ease-in mx-4 md:mx-0  md:left-4 -top-10 lg:text-xl text-sm font-sans lg:font-bold ">
                                        {{ $categories->nama_category }} Universitas Bengkulu Tahun
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>
                                    </div>
                                </div>
                                <div class="  lg:px-6 py-4 -mt-5  ">
                                    <div class="  -mt-6 px-6 ">
                                        @php $i = 1 @endphp

                                        @foreach ($indikators as $item)
                                            <div class="item px-6 py-2 w-full" x-data="{ isOpen: false }">
                                                <p href="#" class="flex   justify-between text-xl font-semibold"
                                                    @click.prevent="isOpen = true">
                                                <h4 class="font-semibold">{{ $i }}.
                                                    {{ $item->nama_indikator }}
                                                </h4>
                                                </p>
                                                <div class="mt-2 duration-300 transform">
                                                    <div class="  pt-1  ">
                                                        <fieldset class=" grid   grid-cols-1  text-left">
                                                            <!-- 5  -->
                                                            <div class="flex  mb-2">
                                                                <input type="radio" id="nilai_{{ $item->id }}_5"
                                                                    name="nilai{{ $item->id }}" value="5"
                                                                    required
                                                                    class="h-4 w-4 border-gray-300 mt-[2px] focus:ring-2 focus:ring-blue-300"
                                                                    aria-labelledby="nilai_{{ $item->id }}_5"
                                                                    aria-describedby="nilai_{{ $item->id }}_5"
                                                                    checked>
                                                                <label for="nilai_{{ $item->id }}_5"
                                                                    class="text-sm font-medium text-gray-900   ml-2 block">
                                                                    Sangat baik
                                                                </label>
                                                            </div>

                                                            <!-- 5  -->
                                                            <div class="flex  mb-2">
                                                                <input type="radio" id="nilai_{{ $item->id }}_4"
                                                                    name="nilai{{ $item->id }}" value="4"
                                                                    required
                                                                    class="h-4 w-4 border-gray-300 mt-[2px] focus:ring-2 focus:ring-blue-300"
                                                                    aria-labelledby="nilai_{{ $item->id }}_4"
                                                                    aria-describedby="nilai_{{ $item->id }}_4">
                                                                <label for="nilai_{{ $item->id }}_4"
                                                                    class="text-sm font-medium text-gray-900   ml-2 block">
                                                                    Baik
                                                                </label>
                                                            </div>

                                                            <!-- 3  -->
                                                            <div class="flex  mb-2">
                                                                <input type="radio" id="nilai_{{ $item->id }}_3"
                                                                    name="nilai{{ $item->id }}" value="3"
                                                                    required
                                                                    class="h-4 w-4 border-gray-300 mt-[2px] focus:ring-2 focus:ring-blue-300"
                                                                    aria-labelledby="nilai_{{ $item->id }}_3"
                                                                    aria-describedby="nilai_{{ $item->id }}_3">
                                                                <label for="nilai_{{ $item->id }}_3"
                                                                    class="text-sm font-medium text-gray-900   ml-2 block">
                                                                    Cukup
                                                                </label>
                                                            </div>

                                                            <!-- 2  -->
                                                            <div class="flex  mb-2">
                                                                <input type="radio" id="nilai_{{ $item->id }}_2"
                                                                    name="nilai{{ $item->id }}" value="2"
                                                                    required
                                                                    class="h-4 w-4 border-gray-300 mt-[2px] focus:ring-2 focus:ring-blue-300"
                                                                    aria-labelledby="nilai_{{ $item->id }}_2"
                                                                    aria-describedby="nilai_{{ $item->id }}_2">
                                                                <label for="nilai_{{ $item->id }}_2"
                                                                    class="text-sm font-medium text-gray-900   ml-2 block">
                                                                    Kurang
                                                                </label>
                                                            </div>

                                                            <!-- 1  -->
                                                            <div class="flex  mb-2">
                                                                <input type="radio" id="nilai_{{ $item->id }}_1"
                                                                    name="nilai{{ $item->id }}" value="1"
                                                                    required
                                                                    class="h-4 w-4 border-gray-300 mt-[2px] focus:ring-2 focus:ring-blue-300"
                                                                    aria-labelledby="nilai_{{ $item->id }}_1"
                                                                    aria-describedby="nilai_{{ $item->id }}_1">
                                                                <label for="nilai_{{ $item->id }}_1"
                                                                    class="text-sm font-medium text-gray-900    ml-2 block">
                                                                    Sangat Kurang
                                                                </label>
                                                            </div>

                                                        </fieldset>
                                                    </div>
                                                </div>
                                                @php $i++ @endphp
                                            </div>
                                            <hr class="  border-2 mb-4">
                                        @endforeach

                                        <div class=" md:mx-4 lg:mx-6 py-6">
                                            <label for="comment" class="block mb-2  font-bold text-gray-900  ">Masukan
                                                Pesan dan Saran Anda Untuk {{ $categories->nama_category }} Universitas
                                                Bengkulu
                                                <span class="text-green-500 text-sm font-normal">(Optional)</span></label>
                                            <textarea name="saran" id="saran" rows="4"
                                                class="block p-2.5 w-full  text-gray-900   rounded-lg   border-[#294DAA] border-2 focus:ring-blue-500 focus:border-blue-500  "
                                                placeholder="Masukan Saran {{ $categories->nama_category }}"></textarea>
                                        </div>
                                        <div class="grid">
                                            <input type="submit" value="SIMPAN SURVEI" name="simpan"
                                                class="inline-block w-full md:w-1/3 place-self-center md:mx-auto px-6 mx-4   py-3 mt-6 mb-0 font-bold text-center text-white uppercase align-middle transition-all  border-0 rounded-lg cursor-pointer    text-md ease-soft-in   bg-blue-500  hover:scale-[98%] active:scale-95 hover:bg-blue-700 tracking-widest hover:shadow-soft-xs    ">
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>

    </section>
@endsection

@push('scripts')
    <script>
        @if (Session::has('message'))
            Swal.fire({
                title: "{{ Session::get('titel') }}",
                text: "{{ Session::get('message') }}",
                icon: "{{ Session::get('alert-type') }}",
                button: "Ok",
            });
        @endif
    </script>
@endpush
