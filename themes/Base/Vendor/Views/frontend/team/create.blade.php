@extends('layouts.user')
@section('content')
    <h2 class="title-bar no-border-bottom">
        {{__("Biodata Jamaah")}}
    </h2>
    @include('admin.message')
    <div class="card">
        <div class="card-body">
            <form action="{{route('vendor.team.store', ['vendorTeam'=>$row->id ?? '0'])}}" method="post" class="input-has-icon">
                @csrf
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>{{__("Title")}} <span class="text-danger">*</span></label>
                                    <select name="gender" class="form-control" required>
                                        <option value="TUAN">TUAN</option>
                                        <option value="NONA">NONA</option>
                                        <option value="NYONYA">NYONYA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label>{{__("Nama Jamaah")}}<span class="text-danger">*</span> (Sesuai Nama Pada Kartu Vaksin)</label>
                                    <input type="text" value="{{old('name',$row->name)}}" name="name" placeholder="{{__("John Doe")}}" class="form-control form-control-sm" required>
                                    <i class="fa fa-user input-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__("Nama Ayah")}}<span class="text-danger">*</span></label>
                                    <input type="text" value="{{old('father_name',$row->father_name)}}" name="father_name" placeholder="{{__("John Doe")}}" class="form-control form-control-sm" required>
                                    <i class="fa fa-user input-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("Jenis Identitas")}} <span class="text-danger">*</span></label>
                                    <select name="jenis_identitas" class="form-control" required>
                                        <option value="NIK">NIK</option>
                                        <option value="KITAS">KITAS</option>
                                        <option value="KITAP">KITAP</option>
                                        <option value="PASPOR">PASPOR</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("No Identitas")}}<span class="text-danger">*</span></label>
                                    <input type="text" value="{{old('no_identitas',$row->no_identitas)}}" name="no_identitas" placeholder="{{__("352152402870002")}}" class="form-control form-control-sm" required>
                                    <i class="fa fa-user input-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("Tempat Lahir")}}<span class="text-danger">*</span></label>
                                    <input type="text" value="{{old('birthcity',$row->birthcity)}}" name="birthcity" placeholder="{{__("Jakarta")}}" class="form-control form-control-sm" required>
                                    <i class="fa fa-building input-icon"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("Tanggal Lahir")}}<span class="text-danger">*</span></label>
                                    <input type="text" value="{{ old('birthday',$row->birthday? display_date($row->birthday) :'') }}" name="birthday" placeholder="" class="form-control form-control-sm date-picker" required>
                                    <i class="fa fa-calendar input-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label>{{__("Alamat")}}<span class="text-danger">*</span></label>
                                    <input type="text" value="{{old('address',$row->address)}}" name="address" placeholder="{{__("Jl. Jend Sudirman No. 1 Rt.001/002")}}" class="form-control form-control-sm" required>
                                    <i class="fa fa-map input-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("Provinsi")}}<span class="text-danger">*</span></label>
                                    @php
                                        $provinces = new Modules\User\Models\Provinsi();
                                        $provinces = $provinces->select('code','name')->get();
                                    @endphp
                                    <select class="form-control sel-provinsi" name="provinsi" id="provinsi" required style="padding: 0.375rem 0.75rem !important;">
                                        <option value="" disabled selected>Pilih Provinsi</option>
                                        @foreach ($provinces as $item)
                                            <option @if (@$user->address->provinsi == $item->code) selected @endif value="{{ $item->code }}"> {{ $item->name ?? '' }} </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("Kabupaten/Kota")}}<span class="text-danger">*</span></label>
                                    <select class="form-control sel-kabupaten" name="kabupaten" required id="form_username_kota_tujuan">
                                        <option value="" disabled selected>Pilih Kota</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("Kecamatan")}}<span class="text-danger">*</span></label>
                                    <select class="form-control sel-kecamatan" name="kecamatan" required>
                                        <option value="" disabled selected>Pilih Kecamatan</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("Kelurahan")}}<span class="text-danger">*</span></label>
                                    <input type="text" value="{{old('kelurahan',$row->kelurahan)}}" name="kelurahan" placeholder="{{__("Sukabumi Selatan")}}" class="form-control form-control-sm" required>
                                    <i class="fa fa-map input-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Nomor Telp.")}}<span class="text-danger">*</span></label>
                                    <input type="text" value="{{old('no_telp',$row->no_telp)}}" name="no_telp" placeholder="{{__("08112349870")}}" class="form-control form-control-sm" required>
                                    <i class="fa fa-phone input-icon"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Nomor Hp.")}}<span class="text-danger">*</span></label>
                                    <input type="text" value="{{old('phone',$row->phone)}}" name="phone" placeholder="{{__("08112349870")}}" class="form-control form-control-sm" required>
                                    <i class="fa fa-mobile input-icon"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Kewarganegaraan")}}<span class="text-danger">*</span></label>
                                    <select name="kewarganegaraan" class="form-control" required>
                                        <option value="WNI">WNI</option>
                                        <option value="WNA">WNA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Status Pernikahan")}}<span class="text-danger">*</span></label>
                                    <select name="married_status" class="form-control" required>
                                        <option value="MENIKAH">MENIKAH</option>
                                        <option value="BELUM MENIKAH">BELUM MENIKAH</option>
                                        <option value="JANDA / DUDA">JANDA / DUDA</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Jenis Pendidikan")}}<span class="text-danger">*</span></label>
                                    <select name="last_edu" class="form-control" required>
                                        <option value="TIDAK SEKOLAH">TIDAK SEKOLAH</option>
                                        <option value="SD/MI">SD/MI</option>
                                        <option value="SMP/MTS">SMP/MTS</option>
                                        <option value="SMA/MA">SMA/MA</option>
                                        <option value="D1">D1</option>
                                        <option value="D2">D2</option>
                                        <option value="D3">D3</option>
                                        <option value="D4/S1">D4/S1</option>
                                        <option value="S2">S2</option>
                                        <option value="S3">S3</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Jenis Pekerjaan")}}<span class="text-danger">*</span></label>
                                    <select name="job" class="form-control" required>
                                        <option value="PNS">PNS</option>
                                        <option value="PEG. SWASTA">PEG. SWASTA</option>
                                        <option value="WIRAUSAHA">WIRAUSAHA</option>
                                        <option value="TNI / POLRI">TNI / POLRI</option>
                                        <option value="PETANI">PETANI</option>
                                        <option value="NELAYAN">NELAYAN</option>
                                        <option value="LAINNYA">LAINNYA</option>
                                        <option value="TIDAK BEKERJA">TIDAK BEKERJA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Alamat E-mail Aktif")}} <span class="text-danger">*</span></label>
                                    <input type="text" name="email" value="{{old('email',$row->email)}}" placeholder="{{__("Alamat E-mail Aktif")}}" class="form-control" required>
                                    <i class="fa fa-envelope input-icon"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Provider Visa")}}</label>
                                    <select name="provider" class="form-control provider">
                                        <option value='' selected disabled>Pilih Provider Visa</option>
                                        <option value='B2C'>B2C</option>
                                        <option value='PT. AERO GLOBE INDONESIA'>PT. AERO GLOBE INDONESIA</option>
                                        <option value='PT. AFRAH DIYANI MANDIRI'>PT. AFRAH DIYANI MANDIRI</option>
                                        <option value='PT. AIDA TOURINDO WISATA'>PT. AIDA TOURINDO WISATA</option>
                                        <option value='PT. AIRMARK INDO WISATA/AIR MARINDO'>PT. AIRMARK INDO WISATA/AIR MARINDO</option>
                                        <option value='PT. AL AHRAM SARANA WISATA'>PT. AL AHRAM SARANA WISATA</option>
                                        <option value='PT. ALAMIN AHSAN TRAVEL'>PT. ALAMIN AHSAN TRAVEL</option>
                                        <option value='PT. ALAMIN MIFTAH PRATAMA'>PT. ALAMIN MIFTAH PRATAMA</option>
                                        <option value='PT. ALAMIR TOUR & TRAVEL'>PT. ALAMIR TOUR & TRAVEL</option>
                                        <option value='PT. AL ANDALUS NUSANTARA TRAVEL'>PT. AL ANDALUS NUSANTARA TRAVEL</option>
                                        <option value='PT. AL AQSHA JISRU DAKWAH'>PT. AL AQSHA JISRU DAKWAH</option>
                                        <option value='PT. ALAZIZ TOUR & TRAVEL'>PT. ALAZIZ TOUR & TRAVEL</option>
                                        <option value='PT. AL BAYT WISATA UNIVERSAL'>PT. AL BAYT WISATA UNIVERSAL</option>
                                        <option value='PT. ALBILAD UNIVERSAL'>PT. ALBILAD UNIVERSAL</option>
                                        <option value='PT. ALBIS NUSA WISATA'>PT. ALBIS NUSA WISATA</option>
                                        <option value='PT. ALFA KAZA MUSTIKA'>PT. ALFA KAZA MUSTIKA</option>
                                        <option value='PT. ALFIDA TOUR & TRAVEL'>PT. ALFIDA TOUR & TRAVEL</option>
                                        <option value='PT. ALFIR WISATA UTAMA'>PT. ALFIR WISATA UTAMA</option>
                                        <option value='PT. ALGAFF SENIOR MANDIRI'>PT. ALGAFF SENIOR MANDIRI</option>
                                        <option value='PT. ALHAMRA RIHLAH INDONESIA'>PT. ALHAMRA RIHLAH INDONESIA</option>
                                        <option value='PT. ALHIJAZ INDOWISATA'>PT. ALHIJAZ INDOWISATA</option>
                                        <option value='PT. ALIA INDAH WISATA'>PT. ALIA INDAH WISATA</option>
                                        <option value='PT. ALINDRA MUTIARA HATI'>PT. ALINDRA MUTIARA HATI</option>
                                        <option value='PT. ALKHALID KUSUMA WARDANI'>PT. ALKHALID KUSUMA WARDANI</option>
                                        <option value='PT. ALKISAI BINA INSANI CITRA WISATA'>PT. ALKISAI BINA INSANI CITRA WISATA</option>
                                        <option value='PT. AL MADINAH MUTIARA SUNNAH'>PT. AL MADINAH MUTIARA SUNNAH</option>
                                        <option value='PT. ALMARHAMAH KARUNIA UTAMA'>PT. ALMARHAMAH KARUNIA UTAMA</option>
                                        <option value='PT. AL MUCHTAR TOUR & TRAVEL'>PT. AL MUCHTAR TOUR & TRAVEL</option>
                                        <option value='PT. ALMUNA INDAH WISATA TOUR & TRAVEL'>PT. ALMUNA INDAH WISATA TOUR & TRAVEL</option>
                                        <option value='PT. ALSEGGAF TRAVEL UMRAH'>PT. ALSEGGAF TRAVEL UMRAH</option>
                                        <option value='PT. AL-SHAFWAH WISATA MANDIRI'>PT. AL-SHAFWAH WISATA MANDIRI</option>
                                        <option value='PT. ALSHA MUTIARA PERSADA'>PT. ALSHA MUTIARA PERSADA</option>
                                        <option value='PT. AMANAH AINIE WISATA'>PT. AMANAH AINIE WISATA</option>
                                        <option value='PT. AMANAH INDAH WISATA'>PT. AMANAH INDAH WISATA</option>
                                        <option value='PT. AMANAH TRAVEL INDONESIA'>PT. AMANAH TRAVEL INDONESIA</option>
                                        <option value='PT. AMAR MADANI MASYHUR'>PT. AMAR MADANI MASYHUR</option>
                                        <option value='PT. AMBASSADOR TOUR & TRAVEL'>PT. AMBASSADOR TOUR & TRAVEL</option>
                                        <option value='PT. AMISYA MUBAROKAH DAULY'>PT. AMISYA MUBAROKAH DAULY</option>
                                        <option value='PT. AN CIPTA WISATA'>PT. AN CIPTA WISATA</option>
                                        <option value='PT. ANDALAS JAYA WISATA'>PT. ANDALAS JAYA WISATA</option>
                                        <option value='PT. ANDROMEDA ATRIA WISATA'>PT. ANDROMEDA ATRIA WISATA</option>
                                        <option value='PT. ANITA SAUDARAKU WISATA'>PT. ANITA SAUDARAKU WISATA</option>
                                        <option value='PT. AN NAMIROH TRAVELINDO'>PT. AN NAMIROH TRAVELINDO</option>
                                        <option value='PT. ANNISA AHMADA TRAVELINDO'>PT. ANNISA AHMADA TRAVELINDO</option>
                                        <option value='PT. AN NUR MAARIF'>PT. AN NUR MAARIF</option>
                                        <option value='PT. ANNUR MAKNAH WISATA'>PT. ANNUR MAKNAH WISATA</option>
                                        <option value='PT. ANUGERAH CITRA MULIA'>PT. ANUGERAH CITRA MULIA</option>
                                        <option value='PT. ARAFAH FARHANA WISATA'>PT. ARAFAH FARHANA WISATA</option>
                                        <option value='PT. ARAFAH MULIA INSANI'>PT. ARAFAH MULIA INSANI</option>
                                        <option value='PT. ARFA MUTIARA MULIA'>PT. ARFA MUTIARA MULIA</option>
                                        <option value='PT. ARMINAREKA PERDANA'>PT. ARMINAREKA PERDANA</option>
                                        <option value='PT. ARMINDO JAYA TUR'>PT. ARMINDO JAYA TUR</option>
                                        <option value='PT. ARRAFSYAH SAFARI HARAMAIN'>PT. ARRAFSYAH SAFARI HARAMAIN</option>
                                        <option value='PT. ARRAHMAN BERKAH WISATA'>PT. ARRAHMAN BERKAH WISATA</option>
                                        <option value='PT. ARRAYYAN AL MUBARAK'>PT. ARRAYYAN AL MUBARAK</option>
                                        <option value='PT. ARSYILA WAHYU TRAVEL'>PT. ARSYILA WAHYU TRAVEL</option>
                                        <option value='PT. ARTHA KARUNIA MULYA'>PT. ARTHA KARUNIA MULYA</option>
                                        <option value='PT. ARUDAM SEMBILAN SEMBILAN'>PT. ARUDAM SEMBILAN SEMBILAN</option>
                                        <option value='PT. ASAMULIA EXPRESS'>PT. ASAMULIA EXPRESS</option>
                                        <option value='PT. ASANKALOKA RIAPINDO'>PT. ASANKALOKA RIAPINDO</option>
                                        <option value='PT. ASFOOR CIPTA MANDIRI'>PT. ASFOOR CIPTA MANDIRI</option>
                                        <option value='PT. ASHFA SHOWARAKUM HARAMAIN'>PT. ASHFA SHOWARAKUM HARAMAIN</option>
                                        <option value='PT. ASIA IMAN WISATA'>PT. ASIA IMAN WISATA</option>
                                        <option value='PT. ASIA UTAMA WISATA'>PT. ASIA UTAMA WISATA</option>
                                        <option value='PT. ASTRI DUTA MANDIRI'>PT. ASTRI DUTA MANDIRI</option>
                                        <option value='PT. ASTRIFA INSAN MADANI'>PT. ASTRIFA INSAN MADANI</option>
                                        <option value='PT. ATHA BAITULLAH'>PT. ATHA BAITULLAH</option>
                                        <option value='PT. ATINA RAHMATAKA WISATA'>PT. ATINA RAHMATAKA WISATA</option>
                                        <option value='PT. AT TAYIBAH'>PT. AT TAYIBAH</option>
                                        <option value='PT. AUFA DUTA WISATA TOUR & TRAVEL'>PT. AUFA DUTA WISATA TOUR & TRAVEL</option>
                                        <option value='PT. AVNNA SEJAHTERA'>PT. AVNNA SEJAHTERA</option>
                                        <option value='PT. AYU AMANAH NUSANTARA'>PT. AYU AMANAH NUSANTARA</option>
                                        <option value='PT. AZKA MANDIRI INTERNASIONAL'>PT. AZKA MANDIRI INTERNASIONAL</option>
                                        <option value='PT. AZ-ZAHRA TOUR & TRAVEL'>PT. AZ-ZAHRA TOUR & TRAVEL</option>
                                        <option value='PT. AZZAM ALBAESUNI'>PT. AZZAM ALBAESUNI</option>
                                        <option value='PT. BAB ALUMRAH TOUR TRAVEL'>PT. BAB ALUMRAH TOUR TRAVEL</option>
                                        <option value='PT. BABUL UMRAH WISATA'>PT. BABUL UMRAH WISATA</option>
                                        <option value='PT. BAHANA SUKSES SEJAHTERA'>PT. BAHANA SUKSES SEJAHTERA</option>
                                        <option value='PT. BAITUSSALAM MANDIRI'>PT. BAITUSSALAM MANDIRI</option>
                                        <option value='PT. BALUBAID IKHWAN'>PT. BALUBAID IKHWAN</option>
                                        <option value='PT. BAROKAH SHOLAWAT ABADI'>PT. BAROKAH SHOLAWAT ABADI</option>
                                        <option value='PT. BERKAH CAHAYA SAFAR'>PT. BERKAH CAHAYA SAFAR</option>
                                        <option value='PT. BIOTA WISATA TOUR DAN TRAVEL'>PT. BIOTA WISATA TOUR DAN TRAVEL</option>
                                        <option value='PT. BIRO PERJALANAN UMUM DAYAKINDO'>PT. BIRO PERJALANAN UMUM DAYAKINDO</option>
                                        <option value='PT. BIRO PERJALANAN WISATA APRILYA DARMA WISATA'>PT. BIRO PERJALANAN WISATA APRILYA DARMA WISATA</option>
                                        <option value='PT. BIRO PERJALANAN WISATA KARYA ADITYA MANDIRI'>PT. BIRO PERJALANAN WISATA KARYA ADITYA MANDIRI</option>
                                        <option value='PT. BIRO PERJALANAN WISATA MUHSININ'>PT. BIRO PERJALANAN WISATA MUHSININ</option>
                                        <option value='PT. BIRO PERJALANAN WISATA NEEKOI'>PT. BIRO PERJALANAN WISATA NEEKOI</option>
                                        <option value='PT. BIRO PERJALANAN WISATA PROCONFO'>PT. BIRO PERJALANAN WISATA PROCONFO</option>
                                        <option value='PT. BIRO PERJALANAN WISATA RAZEK'>PT. BIRO PERJALANAN WISATA RAZEK</option>
                                        <option value='PT. BLOCKING TICKET CENTRE'>PT. BLOCKING TICKET CENTRE</option>
                                        <option value='PT. BOBINSA SURABAYA JAYA'>PT. BOBINSA SURABAYA JAYA</option>
                                        <option value='PT. BUANA PAOTERE WISATA'>PT. BUANA PAOTERE WISATA</option>
                                        <option value='PT. BUANA SENTOSA UTAMA'>PT. BUANA SENTOSA UTAMA</option>
                                        <option value='PT. BUMI NATA WISATA TOURS & TRAVEL'>PT. BUMI NATA WISATA TOURS & TRAVEL</option>
                                        <option value='PT. BUMI NATA WISATA TOURS&TRAVEL'>PT. BUMI NATA WISATA TOURS&TRAVEL</option>
                                        <option value='PT. CAHAYA ANUGRAH AL MAWADDAH'>PT. CAHAYA ANUGRAH AL MAWADDAH</option>
                                        <option value='PT. CAHAYA KAABAH AL HARAMAIN'>PT. CAHAYA KAABAH AL HARAMAIN</option>
                                        <option value='PT. CAHAYA MADINAH MANDIRI'>PT. CAHAYA MADINAH MANDIRI</option>
                                        <option value='PT. CAHAYA TIGA PESONA'>PT. CAHAYA TIGA PESONA</option>
                                        <option value='PT. CAKRA MANDIRI UTAMA'>PT. CAKRA MANDIRI UTAMA</option>
                                        <option value='PT. CENTRAL GLOBAL NETWORK'>PT. CENTRAL GLOBAL NETWORK</option>
                                        <option value='PT. CITRA CERIA USAHA KHALIFAH'>PT. CITRA CERIA USAHA KHALIFAH</option>
                                        <option value='PT. CITRA SAHABAT ASIA'>PT. CITRA SAHABAT ASIA</option>
                                        <option value='PT. COMEUMROH WAHANA AMANAH'>PT. COMEUMROH WAHANA AMANAH</option>
                                        <option value='PT. DAEHATUR EXPRESS'>PT. DAEHATUR EXPRESS</option>
                                        <option value='PT. DARMAWISATA INDONESIA'>PT. DARMAWISATA INDONESIA</option>
                                        <option value='PT. DARUL HAROMAIN'>PT. DARUL HAROMAIN</option>
                                        <option value='PT. DARUL HIKMAH MANDIRI'>PT. DARUL HIKMAH MANDIRI</option>
                                        <option value='PT. DARUL MANASEK INTERNASIONAL'>PT. DARUL MANASEK INTERNASIONAL</option>
                                        <option value='PT. DARUL UMROH ALHARAMAIN'>PT. DARUL UMROH ALHARAMAIN</option>
                                        <option value='PT. DAWOOD ANDALAN HARAMAIN'>PT. DAWOOD ANDALAN HARAMAIN</option>
                                        <option value='PT. DELTA LARAS WISATA'>PT. DELTA LARAS WISATA</option>
                                        <option value='PT. DENA VISTAMA'>PT. DENA VISTAMA</option>
                                        <option value='PT. DEWISERASI INDAHWISATA'>PT. DEWISERASI INDAHWISATA</option>
                                        <option value='PT. DHIYAA EL HARAMAIN EL MUBARAKAH'>PT. DHIYAA EL HARAMAIN EL MUBARAKAH</option>
                                        <option value='PT. DHUYUFUR ROHMAN HAROMAIN'>PT. DHUYUFUR ROHMAN HAROMAIN</option>
                                        <option value='PT. DIAN ALMAAZ WISATA'>PT. DIAN ALMAAZ WISATA</option>
                                        <option value='PT. DIDI MABRUK BAYANAKA'>PT. DIDI MABRUK BAYANAKA</option>
                                        <option value='PT. DIVA MABRURO'>PT. DIVA MABRURO</option>
                                        <option value='PT. DIYO SIBA'>PT. DIYO SIBA</option>
                                        <option value='PT. DJAMILAH NURUL HIKMAH'>PT. DJAMILAH NURUL HIKMAH</option>
                                        <option value='PT. DREAM TOUR & TRAVEL'>PT. DREAM TOUR & TRAVEL</option>
                                        <option value='PT. DUTA FARAS'>PT. DUTA FARAS</option>
                                        <option value='PT. DUTA PUTRA DELIM'>PT. DUTA PUTRA DELIM</option>
                                        <option value='PT. DWI AMANAH LESTARI'>PT. DWI AMANAH LESTARI</option>
                                        <option value='PT. DWINS BERKAH UTAMA'>PT. DWINS BERKAH UTAMA</option>
                                        <option value='PT. EBAD ALRAHMAN WISATA'>PT. EBAD ALRAHMAN WISATA</option>
                                        <option value='PT. EDIPENIN TRAVEL'>PT. EDIPENIN TRAVEL</option>
                                        <option value='PT. ELHADY GRUP INTERNASIONAL'>PT. ELHADY GRUP INTERNASIONAL</option>
                                        <option value='PT. ELHAQQ TOUR RELIGI'>PT. ELHAQQ TOUR RELIGI</option>
                                        <option value='PT. ELREY PURI MALAK'>PT. ELREY PURI MALAK</option>
                                        <option value='PT. ELTEYBA MEDINA FAUZANA'>PT. ELTEYBA MEDINA FAUZANA</option>
                                        <option value='PT.ELTURA BERKAH SEHATI'>PT.ELTURA BERKAH SEHATI</option>
                                        <option value='PT. EMMA TOUR DAN TRAVEL'>PT. EMMA TOUR DAN TRAVEL</option>
                                        <option value='PT. FADHILAH AMANAH WISATA'>PT. FADHILAH AMANAH WISATA</option>
                                        <option value='PT. FAHIRA ARAFAH UTAMA'>PT. FAHIRA ARAFAH UTAMA</option>
                                        <option value='PT. FAHMY GLOBAL MANDIRI'>PT. FAHMY GLOBAL MANDIRI</option>
                                        <option value='PT. FAJAR BERKAH ILAHI'>PT. FAJAR BERKAH ILAHI</option>
                                        <option value='PT. FAJRUL IKHSAN WISATA'>PT. FAJRUL IKHSAN WISATA</option>
                                        <option value='PT FAROQ SULAIMAN AL FATAH TOURS & TRAVEL'>PT FAROQ SULAIMAN AL FATAH TOURS & TRAVEL</option>
                                        <option value='PT. FATH INDAH TRAVEL SERVICES'>PT. FATH INDAH TRAVEL SERVICES</option>
                                        <option value='PT. FAUZI MULIA BERSAMA'>PT. FAUZI MULIA BERSAMA</option>
                                        <option value='PT. FAZARY WISATA'>PT. FAZARY WISATA</option>
                                        <option value='PT. FINUSA KARYA WISATA'>PT. FINUSA KARYA WISATA</option>
                                        <option value='PT. FIO AMANAH PERDANA'>PT. FIO AMANAH PERDANA</option>
                                        <option value='PT. FIRDAUS MULIA ABADI'>PT. FIRDAUS MULIA ABADI</option>
                                        <option value='PT. FRESHNEL KREASINDO PERKASA'>PT. FRESHNEL KREASINDO PERKASA</option>
                                        <option value='PT. FUTTUH MAKKAH ALWAHYU'>PT. FUTTUH MAKKAH ALWAHYU</option>
                                        <option value='PT. GADIKAH MANDIRI ISLAMI'>PT. GADIKAH MANDIRI ISLAMI</option>
                                        <option value='PT. GAIDO AZZA DARUSSALAM INDONESIA'>PT. GAIDO AZZA DARUSSALAM INDONESIA</option>
                                        <option value='PT. GALATAMA'>PT. GALATAMA</option>
                                        <option value='PT. GALUH MUTIARA WISATA'>PT. GALUH MUTIARA WISATA</option>
                                        <option value='PT. GAMALAMA INDO PESONA'>PT. GAMALAMA INDO PESONA</option>
                                        <option value='PT. GAMAL HIKMAH'>PT. GAMAL HIKMAH</option>
                                        <option value='PT. GARISLURUS LINTAS SEMESTA'>PT. GARISLURUS LINTAS SEMESTA</option>
                                        <option value='PT. GEMILANG DUNIA WISATA'>PT. GEMILANG DUNIA WISATA</option>
                                        <option value='PT. GEMILANG MULTAZAM MITRA SAKTI'>PT. GEMILANG MULTAZAM MITRA SAKTI</option>
                                        <option value='PT. GENENA FERDOWS INTERNATIONAL'>PT. GENENA FERDOWS INTERNATIONAL</option>
                                        <option value='PT. GESYA PRIMA BIRO PERJALANAN UMUM'>PT. GESYA PRIMA BIRO PERJALANAN UMUM</option>
                                        <option value='PT. GETWAY TOUR AND TRAVEL'>PT. GETWAY TOUR AND TRAVEL</option>
                                        <option value='PT. GHANIYA ZILIA RAHMAN'>PT. GHANIYA ZILIA RAHMAN</option>
                                        <option value='PT. GLOBALINDO SUKSES MAKSIMA'>PT. GLOBALINDO SUKSES MAKSIMA</option>
                                        <option value='PT. GLOBAL WISATA IDAMAN'>PT. GLOBAL WISATA IDAMAN</option>
                                        <option value='PT. GOENAWAN ERAWISATA TOUR & TRAVEL'>PT. GOENAWAN ERAWISATA TOUR & TRAVEL</option>
                                        <option value='PT GOLDY MULIA WISATA'>PT GOLDY MULIA WISATA</option>
                                        <option value='PT. GRANADA WISATA'>PT. GRANADA WISATA</option>
                                        <option value='PT. GRAND DARUSSALAM'>PT. GRAND DARUSSALAM</option>
                                        <option value='PT. HAJAR ASWAD MUBAROQ'>PT. HAJAR ASWAD MUBAROQ</option>
                                        <option value='PT. HAMSA MANDIRI INTERNATIONAL TOURS'>PT. HAMSA MANDIRI INTERNATIONAL TOURS</option>
                                        <option value='PT. HANA ASIA WISATA'>PT. HANA ASIA WISATA</option>
                                        <option value='PT. HENIRA CITRA UTAMA'>PT. HENIRA CITRA UTAMA</option>
                                        <option value='PT. HIKMAH JAYA WISATA'>PT. HIKMAH JAYA WISATA</option>
                                        <option value='PT. HISAR GLOBAL INDONESIA'>PT. HISAR GLOBAL INDONESIA</option>
                                        <option value='PT. IBS BUANA SEJAHTERA'>PT. IBS BUANA SEJAHTERA</option>
                                        <option value='PT. IMPRESSAS MEDIA WISATA'>PT. IMPRESSAS MEDIA WISATA</option>
                                        <option value='PT. INDO CITRA TAMASYA'>PT. INDO CITRA TAMASYA</option>
                                        <option value='PT. INDOJAVA MULIA WISATA'>PT. INDOJAVA MULIA WISATA</option>
                                        <option value='PT. INDONESIA CENDEKIA MANDIRI'>PT. INDONESIA CENDEKIA MANDIRI</option>
                                        <option value='PT. INDONESIA INTERNATIONAL BUSINESS'>PT. INDONESIA INTERNATIONAL BUSINESS</option>
                                        <option value='PT. INHIL ARJUNA WISATA'>PT. INHIL ARJUNA WISATA</option>
                                        <option value='PT. INTAN SALSABILA'>PT. INTAN SALSABILA</option>
                                        <option value='PT. INTI UMMUL QURO'>PT. INTI UMMUL QURO</option>
                                        <option value='PT. JANNAH FIRDAUS'>PT. JANNAH FIRDAUS</option>
                                        <option value='PT. JASIYAH TRAVEL SERVICE'>PT. JASIYAH TRAVEL SERVICE</option>
                                        <option value='PT. JEJAK IMANI BERKAH BERSAMA'>PT. JEJAK IMANI BERKAH BERSAMA</option>
                                        <option value='PT. KAFILAH MAGHFIRAH WISATA'>PT. KAFILAH MAGHFIRAH WISATA</option>
                                        <option value='PT. KAHA HOLIDAY INTERNATIONAL'>PT. KAHA HOLIDAY INTERNATIONAL</option>
                                        <option value='PT. KAISA ROSSIE'>PT. KAISA ROSSIE</option>
                                        <option value='PT. KALTRABU INDAH'>PT. KALTRABU INDAH</option>
                                        <option value='PT. KAMILAH BERKAT GURU'>PT. KAMILAH BERKAT GURU</option>
                                        <option value='PT. KANAYA WISATA JAYA'>PT. KANAYA WISATA JAYA</option>
                                        <option value='PT. KANOMAS ARCI WISATA'>PT. KANOMAS ARCI WISATA</option>
                                        <option value='PT. KARSHINTA TUNGGAL WISATA'>PT. KARSHINTA TUNGGAL WISATA</option>
                                        <option value='PT. KEMANG NUSANTARA TRAVEL'>PT. KEMANG NUSANTARA TRAVEL</option>
                                        <option value='PT. KENCANA RAUDHAH JAYA'>PT. KENCANA RAUDHAH JAYA</option>
                                        <option value='PT. KHARISSA PERMAI HOLIDAY'>PT. KHARISSA PERMAI HOLIDAY</option>
                                        <option value='PT. KHAZZANAH AL-ANSHARY'>PT. KHAZZANAH AL-ANSHARY</option>
                                        <option value='PT. KIBLATAIN JAYA WISATA'>PT. KIBLATAIN JAYA WISATA</option>
                                        <option value='PT. KOTA PIRING KENCANA'>PT. KOTA PIRING KENCANA</option>
                                        <option value='PT. LABBAIKA CIPTA IMANI'>PT. LABBAIKA CIPTA IMANI</option>
                                        <option value='PT LABBAIKA QOLBU INTERNASIONAL'>PT LABBAIKA QOLBU INTERNASIONAL</option>
                                        <option value='PT LAMAHU TOUR & TRAVEL'>PT LAMAHU TOUR & TRAVEL</option>
                                        <option value='PT. LAN TABUR UTAMA WISATA'>PT. LAN TABUR UTAMA WISATA</option>
                                        <option value='PT. LINTAS ISKANDARIA'>PT. LINTAS ISKANDARIA</option>
                                        <option value='PT. MABRUR TOUR & TRAVEL'>PT. MABRUR TOUR & TRAVEL</option>
                                        <option value='PT. MADANI BINA BERSAMA'>PT. MADANI BINA BERSAMA</option>
                                        <option value='PT. MADANI PRABU JAYA'>PT. MADANI PRABU JAYA</option>
                                        <option value='PT. MADINAH IMAN WISATA'>PT. MADINAH IMAN WISATA</option>
                                        <option value='PT. MADINA WISATA ABADI'>PT. MADINA WISATA ABADI</option>
                                        <option value='PT. MAKADINAH RAMANI JAYA'>PT. MAKADINAH RAMANI JAYA</option>
                                        <option value='PT. MAKARIM EL AKHLAK TOURINDO'>PT. MAKARIM EL AKHLAK TOURINDO</option>
                                        <option value='PT. MAKASSAR MANDIRI WISATA'>PT. MAKASSAR MANDIRI WISATA</option>
                                        <option value='PT. MAKKAH MADINAH MANDIRI'>PT. MAKKAH MADINAH MANDIRI</option>
                                        <option value='PT. MAKTOUR'>PT. MAKTOUR</option>
                                        <option value='PT. MALIKA WISATA UTAMA'>PT. MALIKA WISATA UTAMA</option>
                                        <option value='PT. MALINDO MEKKAH MADINAH'>PT. MALINDO MEKKAH MADINAH</option>
                                        <option value='PT. MANARA TABA INDONESIA'>PT. MANARA TABA INDONESIA</option>
                                        <option value='PT. MANASIK PRIMA'>PT. MANASIK PRIMA</option>
                                        <option value='PT. MANAYA INDONESIA TOUR&TRAVEL'>PT. MANAYA INDONESIA TOUR&TRAVEL</option>
                                        <option value='PT. MARBA WISATA INDONESIA'>PT. MARBA WISATA INDONESIA</option>
                                        <option value='PT. MARCO TOUR AND TRAVEL'>PT. MARCO TOUR AND TRAVEL</option>
                                        <option value='PT. MARHABAN MAKKAH MADINAH'>PT. MARHABAN MAKKAH MADINAH</option>
                                        <option value='PT. MARMARA GLOBAL WISATA'>PT. MARMARA GLOBAL WISATA</option>
                                        <option value='PT. MARWAH SARI UTAMA'>PT. MARWAH SARI UTAMA</option>
                                        <option value='PT. MASINDO BUANA WISATA'>PT. MASINDO BUANA WISATA</option>
                                        <option value='PT. MASWAH BAKTI WISATA'>PT. MASWAH BAKTI WISATA</option>
                                        <option value='PT. MASY'ARIL HARAM'>PT. MASY'ARIL HARAM</option>
                                        <option value='PT. MATAHARI WISATA MAKASSAR'>PT. MATAHARI WISATA MAKASSAR</option>
                                        <option value='PT. MATIAS JAYA ABADI'>PT. MATIAS JAYA ABADI</option>
                                        <option value='PT. MAZIYA RIZKI ALAMI'>PT. MAZIYA RIZKI ALAMI</option>
                                        <option value='PT. MECCA SUKSES INTERNASIONAL'>PT. MECCA SUKSES INTERNASIONAL</option>
                                        <option value='PT. MEGACITRA INTINAMANDIRI'>PT. MEGACITRA INTINAMANDIRI</option>
                                        <option value='PT. MEGAH BERKAH WISATA'>PT. MEGAH BERKAH WISATA</option>
                                        <option value='PT. MEIDA WISATA'>PT. MEIDA WISATA</option>
                                        <option value='PT. MEKAH TUR INDONESIA'>PT. MEKAH TUR INDONESIA</option>
                                        <option value='PT. METEOR KENCANA WISATA'>PT. METEOR KENCANA WISATA</option>
                                        <option value='PT. MIDEAST EXPRESS'>PT. MIDEAST EXPRESS</option>
                                        <option value='PT. MILARI RISALAH WISATA'>PT. MILARI RISALAH WISATA</option>
                                        <option value='PT. MINA DARUSSALAM MANDIRI TUR'>PT. MINA DARUSSALAM MANDIRI TUR</option>
                                        <option value='PT. MINAMAS ANGKASA SAKTI'>PT. MINAMAS ANGKASA SAKTI</option>
                                        <option value='PT MINANG KHAWAS WISATA'>PT MINANG KHAWAS WISATA</option>
                                        <option value='PT. MS. AISHAH MANDIRI'>PT. MS. AISHAH MANDIRI</option>
                                        <option value='PT. MUKHTARA INDONESIA WISATA'>PT. MUKHTARA INDONESIA WISATA</option>
                                        <option value='PT. MULIA RAHAYU MITRA'>PT. MULIA RAHAYU MITRA</option>
                                        <option value='PT. MULTAZAM WISATA'>PT. MULTAZAM WISATA</option>
                                        <option value='PT. MUNA BINA INSANI'>PT. MUNA BINA INSANI</option>
                                        <option value='PT. MUSAFIR LINTAS SAHARA'>PT. MUSAFIR LINTAS SAHARA</option>
                                        <option value='PT. MUSTIKA KARTIKA SAMUDERA'>PT. MUSTIKA KARTIKA SAMUDERA</option>
                                        <option value='PT. MUTIARA SUNNAH MANDIRI'>PT. MUTIARA SUNNAH MANDIRI</option>
                                        <option value='PT. NABILA SURABAYA PERDANA'>PT. NABILA SURABAYA PERDANA</option>
                                        <option value='PT. NAMIRA'>PT. NAMIRA</option>
                                        <option value='PT. NAUFA MUTIARA PERSADA'>PT. NAUFA MUTIARA PERSADA</option>
                                        <option value='PT. NAZAR JAYA MANDIRI'>PT. NAZAR JAYA MANDIRI</option>
                                        <option value='PT. NEWCITY BERJAYA LESTARI'>PT. NEWCITY BERJAYA LESTARI</option>
                                        <option value='PT. NIPINDO ANTAR WISATA'>PT. NIPINDO ANTAR WISATA</option>
                                        <option value='PT. NISMA WISATA HAROMAIN'>PT. NISMA WISATA HAROMAIN</option>
                                        <option value='PT. NOOR ABIKA TOURS'>PT. NOOR ABIKA TOURS</option>
                                        <option value='PT. NOORUHA KIRANA INDONESIA'>PT. NOORUHA KIRANA INDONESIA</option>
                                        <option value='PT. NOVAVIL MUTIARA UTAMA'>PT. NOVAVIL MUTIARA UTAMA</option>
                                        <option value='PT. NUANSA CERIA PESONA'>PT. NUANSA CERIA PESONA</option>
                                        <option value='PT. NUR AMANAH WISATA'>PT. NUR AMANAH WISATA</option>
                                        <option value='PT. NURANI EL MISBAH TOUR & TRAVEL'>PT. NURANI EL MISBAH TOUR & TRAVEL</option>
                                        <option value='PT. NUR ASSYFA BERKAH'>PT. NUR ASSYFA BERKAH</option>
                                        <option value='PT. NUR HARAMAIN MULIA'>PT. NUR HARAMAIN MULIA</option>
                                        <option value='PT. NURINDO WISATA'>PT. NURINDO WISATA</option>
                                        <option value='PT. NURUL ZAHRA'>PT. NURUL ZAHRA</option>
                                        <option value='PT. PANCA MITRA INTEGRITY'>PT. PANCA MITRA INTEGRITY</option>
                                        <option value='PT. PANGHEGAR PUTRA'>PT. PANGHEGAR PUTRA</option>
                                        <option value='PT. PANGUJI LUHUR UTAMA'>PT. PANGUJI LUHUR UTAMA</option>
                                        <option value='PT. PANTRAVEL'>PT. PANTRAVEL</option>
                                        <option value='PT. PATUNA MEKAR JAYA'>PT. PATUNA MEKAR JAYA</option>
                                        <option value='PT. PENATA RIHLAH'>PT. PENATA RIHLAH</option>
                                        <option value='PT. PENJURU WISATA NEGERI'>PT. PENJURU WISATA NEGERI</option>
                                        <option value='PT. PERMATA KENCANA MULIA'>PT. PERMATA KENCANA MULIA</option>
                                        <option value='PT. PESONA MOZAIK'>PT. PESONA MOZAIK</option>
                                        <option value='PT. PESONA MUDA PRIMA TOURS'>PT. PESONA MUDA PRIMA TOURS</option>
                                        <option value='PT. PRABA ARTA BUANA UTAMA/PRABA'>PT. PRABA ARTA BUANA UTAMA/PRABA</option>
                                        <option value='PT. PRAYOGI LINTAS PERSADA'>PT. PRAYOGI LINTAS PERSADA</option>
                                        <option value='PT. PRIMA ASTUTI SEJAHTERA'>PT. PRIMA ASTUTI SEJAHTERA</option>
                                        <option value='PT. PRIMA TOUR & TRAVEL'>PT. PRIMA TOUR & TRAVEL</option>
                                        <option value='PT. PRIMA UNGGUL GLOBAL'>PT. PRIMA UNGGUL GLOBAL</option>
                                        <option value='PT. PUNAMA MULIA WISATA'>PT. PUNAMA MULIA WISATA</option>
                                        <option value='PT. QORYATUL HAYYAT'>PT. QORYATUL HAYYAT</option>
                                        <option value='PT. RABBANI SEMESTA UTAMA'>PT. RABBANI SEMESTA UTAMA</option>
                                        <option value='PT. RABIHA KARYA BERSAMA TOURS AND TRAVEL'>PT. RABIHA KARYA BERSAMA TOURS AND TRAVEL</option>
                                        <option value='PT. RADIAN KHARISMA WISATA'>PT. RADIAN KHARISMA WISATA</option>
                                        <option value='PT. RAFA LINTAS CAKRAWALA TOURS & TRAVEL'>PT. RAFA LINTAS CAKRAWALA TOURS & TRAVEL</option>
                                        <option value='PT. RAFFI INDO MAKMUR'>PT. RAFFI INDO MAKMUR</option>
                                        <option value='PT. RAMADANI JAYA TOUR'>PT. RAMADANI JAYA TOUR</option>
                                        <option value='PT. RANDI PRIMA WISATA'>PT. RANDI PRIMA WISATA</option>
                                        <option value='PT. RATNA AZIZAH MUSTIKA'>PT. RATNA AZIZAH MUSTIKA</option>
                                        <option value='PT. RATU HAMIDAH SAMPURNA BERSAUDARA'>PT. RATU HAMIDAH SAMPURNA BERSAUDARA</option>
                                        <option value='PT. RAUDAH AMANI WISATA'>PT. RAUDAH AMANI WISATA</option>
                                        <option value='PT. RAUDHAH MULTAZAM INDONESIA'>PT. RAUDHAH MULTAZAM INDONESIA</option>
                                        <option value='PT. RAWASINDO'>PT. RAWASINDO</option>
                                        <option value='PT. RAZAN GROUP INDONESIA'>PT. RAZAN GROUP INDONESIA</option>
                                        <option value='PT. REHABUL HARAMAIN SYARIFAIN'>PT. REHABUL HARAMAIN SYARIFAIN</option>
                                        <option value='PT RENAZKIA REINDO WISATA'>PT RENAZKIA REINDO WISATA</option>
                                        <option value='PT. RESI MANUNGGAL LESTARI'>PT. RESI MANUNGGAL LESTARI</option>
                                        <option value='PT. RIAU WISATA HATI'>PT. RIAU WISATA HATI</option>
                                        <option value='PT. RIFLA WISATA UTAMA'>PT. RIFLA WISATA UTAMA</option>
                                        <option value='PT. RIHLAH ALATAS WISATA'>PT. RIHLAH ALATAS WISATA</option>
                                        <option value='PT. RIHLAH ASSOFA AMANAH'>PT. RIHLAH ASSOFA AMANAH</option>
                                        <option value='PT. RIHLATUL HIDAYAH WISATA'>PT. RIHLATUL HIDAYAH WISATA</option>
                                        <option value='PT. RISALAH MADINA TIARA'>PT. RISALAH MADINA TIARA</option>
                                        <option value='PT RIYADHULJANNAH TOUR & TRAVEL'>PT RIYADHULJANNAH TOUR & TRAVEL</option>
                                        <option value='PT. RIZMA SABILUL HAROM'>PT. RIZMA SABILUL HAROM</option>
                                        <option value='PT. RIZQUNA MEKKAH MADINAH'>PT. RIZQUNA MEKKAH MADINAH</option>
                                        <option value='PT. SADEWA ANANDEA WISATA'>PT. SADEWA ANANDEA WISATA</option>
                                        <option value='PT. SAFA NISA RIZKY'>PT. SAFA NISA RIZKY</option>
                                        <option value='PT. SAFARI HARISTY WISATA'>PT. SAFARI HARISTY WISATA</option>
                                        <option value='PT. SAFINA ASSALAM TOUR'>PT. SAFINA ASSALAM TOUR</option>
                                        <option value='PT. SAFINA DANIA WISATA'>PT. SAFINA DANIA WISATA</option>
                                        <option value='PT. SAHABAT DUA ARAH'>PT. SAHABAT DUA ARAH</option>
                                        <option value='PT. SAHARA DZUMIRRA INTERNATIONAL'>PT. SAHARA DZUMIRRA INTERNATIONAL</option>
                                        <option value='PT. SAKINAH TOUR & TRAVEL'>PT. SAKINAH TOUR & TRAVEL</option>
                                        <option value='PT. SALWANA GLOBAL SARANA'>PT. SALWANA GLOBAL SARANA</option>
                                        <option value='PT. SAMAWA BERKAH WISATA'>PT. SAMAWA BERKAH WISATA</option>
                                        <option value='PT. SAUDI PATRIA WISATA'>PT. SAUDI PATRIA WISATA</option>
                                        <option value='PT. SELARAS CINTANUSA WISATA'>PT. SELARAS CINTANUSA WISATA</option>
                                        <option value='PT. SHAFIRA LINTAS SEMESTA'>PT. SHAFIRA LINTAS SEMESTA</option>
                                        <option value='PT. SHAZA QOLBU IZMIR'>PT. SHAZA QOLBU IZMIR</option>
                                        <option value='PT. SIANOK INDAH HOLIDAY'>PT. SIANOK INDAH HOLIDAY</option>
                                        <option value='PT. SIAR HARAMAIN INTERNATIONAL WISATA'>PT. SIAR HARAMAIN INTERNATIONAL WISATA</option>
                                        <option value='PT. SILVER SILK TOUR & TRAVEL'>PT. SILVER SILK TOUR & TRAVEL</option>
                                        <option value='PT. SINDO WISATA'>PT. SINDO WISATA</option>
                                        <option value='PT. SOLUSINDO JAYA PRATAMA GROUP'>PT. SOLUSINDO JAYA PRATAMA GROUP</option>
                                        <option value='PT. SOLUTION INDONESIA'>PT. SOLUTION INDONESIA</option>
                                        <option value='PT. SPIDEST INTERNASIONAL'>PT. SPIDEST INTERNASIONAL</option>
                                        <option value='PT. SRIKANDI NUANSA'>PT. SRIKANDI NUANSA</option>
                                        <option value='PT. SRIWIJAYA MEGA WISATA'>PT. SRIWIJAYA MEGA WISATA</option>
                                        <option value='PT. STARINDO MITRADASA CIPTA'>PT. STARINDO MITRADASA CIPTA</option>
                                        <option value='PT. SUKSES INTERNASIONAL TOUR & TRAVEL'>PT. SUKSES INTERNASIONAL TOUR & TRAVEL</option>
                                        <option value='PT. SUTRA TOUR HIDAYAH'>PT. SUTRA TOUR HIDAYAH</option>
                                        <option value='PT. SWADHARMA TRAVELINDO'>PT. SWADHARMA TRAVELINDO</option>
                                        <option value='PT. SYAKIRA ASFARINA'>PT. SYAKIRA ASFARINA</option>
                                        <option value='PT SYAMMAS ANGKASA WISATA'>PT SYAMMAS ANGKASA WISATA</option>
                                        <option value='PT. TAJAK RAMADHAN'>PT. TAJAK RAMADHAN</option>
                                        <option value='PT. TAMASYA INDAH TOUR & TRAVEL'>PT. TAMASYA INDAH TOUR & TRAVEL</option>
                                        <option value='PT. TAMA WISATA INDONESIA'>PT. TAMA WISATA INDONESIA</option>
                                        <option value='PT. TANUR MUTHMAINNAH TOUR'>PT. TANUR MUTHMAINNAH TOUR</option>
                                        <option value='PT. TAQWA CAHAYA SEMESTA'>PT. TAQWA CAHAYA SEMESTA</option>
                                        <option value='PT. TASBIH AMANAH BERSAMA'>PT. TASBIH AMANAH BERSAMA</option>
                                        <option value='PT. TAUBA ZAKKA ATKIA'>PT. TAUBA ZAKKA ATKIA</option>
                                        <option value='PT. TAWAKAL INTERNASIONAL'>PT. TAWAKAL INTERNASIONAL</option>
                                        <option value='PT TAYSIR TOUR & TRAVEL'>PT TAYSIR TOUR & TRAVEL</option>
                                        <option value='PT. TAZKIYAH GLOBAL MANDIRI'>PT. TAZKIYAH GLOBAL MANDIRI</option>
                                        <option value='PT. TIFA JAYA ABADI'>PT. TIFA JAYA ABADI</option>
                                        <option value='PT. TISAGA MULTAZAM UTAMA'>PT. TISAGA MULTAZAM UTAMA</option>
                                        <option value='PT. TRIDAYA PESONA WISATA'>PT. TRIDAYA PESONA WISATA</option>
                                        <option value='PT. TRIMAGNA ADHI WISATA'>PT. TRIMAGNA ADHI WISATA</option>
                                        <option value='PT. TRIPURI WISATA'>PT. TRIPURI WISATA</option>
                                        <option value='PT. TRITAMA TOUR TRAVEL'>PT. TRITAMA TOUR TRAVEL</option>
                                        <option value='PT. TUJUH PUTRI BAROKAH'>PT. TUJUH PUTRI BAROKAH</option>
                                        <option value='PT. TUNAS RIZKI SEMESTA'>PT. TUNAS RIZKI SEMESTA</option>
                                        <option value='PT. TURISINA BUANA'>PT. TURISINA BUANA</option>
                                        <option value='PT. TUR SILATURAHMI NABI'>PT. TUR SILATURAHMI NABI</option>
                                        <option value='PT. UMI TOUR & TRAVEL'>PT. UMI TOUR & TRAVEL</option>
                                        <option value='PT. VENTURA SEMESTA WISATA'>PT. VENTURA SEMESTA WISATA</option>
                                        <option value='PT. VIZITRIP GLOBAL TOUR'>PT. VIZITRIP GLOBAL TOUR</option>
                                        <option value='PT. WAHYU TITIAN INSANI'>PT. WAHYU TITIAN INSANI</option>
                                        <option value='PT. WISATA PILIHAN'>PT. WISATA PILIHAN</option>
                                        <option value='PT. WISATA RAHMAH SEMESTA'>PT. WISATA RAHMAH SEMESTA</option>
                                        <option value='PT. YASDIN TRAVEL'>PT. YASDIN TRAVEL</option>
                                        <option value='PT. YASSINTA ANDROMEDA KENCANA'>PT. YASSINTA ANDROMEDA KENCANA</option>
                                        <option value='PT. YASTHA MANDIRI'>PT. YASTHA MANDIRI</option>
                                        <option value='PT. ZAHARA MUTIARA BAKKAH'>PT. ZAHARA MUTIARA BAKKAH</option>
                                        <option value='PT. ZAHRA OTO MANDIRI'>PT. ZAHRA OTO MANDIRI</option>
                                        <option value='PT. ZAM ZAM MANDIRI'>PT. ZAM ZAM MANDIRI</option>
                                        <option value='PT. ZAMZAM SUMBULA THOYYIBBAH'>PT. ZAMZAM SUMBULA THOYYIBBAH</option>
                                        <option value='PT. ZHAFIRAH MITRA MADANI'>PT. ZHAFIRAH MITRA MADANI</option>
                                        <option value='PT. ZIARAH HATI NURANI'>PT. ZIARAH HATI NURANI</option>
                                        <option value='PT. ZIAR NIDA UL HARAMAIN'>PT. ZIAR NIDA UL HARAMAIN</option>
                                        <option value='PT. ZIMAH TOUR & TRAVEL'>PT. ZIMAH TOUR & TRAVEL</option>
                                        <option value='PT. ZNH INTERNASIONAL INDONESIA'>PT. ZNH INTERNASIONAL INDONESIA</option>
                                        <option value='PT. ZONA ASIA HAROMAIN'>PT. ZONA ASIA HAROMAIN</option>
                                        <option value='PT. ZULIAN KAMSAINDO TOUR & TRAVEL'>PT. ZULIAN KAMSAINDO TOUR & TRAVEL</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Asuransi")}}</label>
                                    <select name="asuransi" class="form-control asuransi">
                                        <option value='' selected disabled>Pilih Asuransi</option>
                                        <option value='AJS AMANAH JIWA GIRI ARTHA'>AJS AMANAH JIWA GIRI ARTHA</option>
                                        <option value='ASURANSI ASKRIDA SYARIAH'>ASURANSI ASKRIDA SYARIAH</option>
                                        <option value='ASURANSI BRINS'>ASURANSI BRINS</option>
                                        <option value='ASURANSI CENTRAL ASIA SYARIAH'>ASURANSI CENTRAL ASIA SYARIAH</option>
                                        <option value='ASURANSI CHUBB SYARIAH'>ASURANSI CHUBB SYARIAH</option>
                                        <option value='ASURANSI JIWA SYARIAH AL AMIN'>ASURANSI JIWA SYARIAH AL AMIN</option>
                                        <option value='ASURANSI MAXIMUS GRAHA PERSADA UNIT SYARIAH'>ASURANSI MAXIMUS GRAHA PERSADA UNIT SYARIAH</option>
                                        <option value='ASURANSI RELIANCE INDONESIA UNIT SYARIAH'>ASURANSI RELIANCE INDONESIA UNIT SYARIAH</option>
                                        <option value='ASURANSI SINARMAS SYARIAH'>ASURANSI SINARMAS SYARIAH</option>
                                        <option value='ASURANSI SONWELIS TAKAFUL'>ASURANSI SONWELIS TAKAFUL</option>
                                        <option value='ASURANSI TAKAFUL UMUM'>ASURANSI TAKAFUL UMUM</option>
                                        <option value='ASURANSI TRI PAKARTA UNIT SYARIAH'>ASURANSI TRI PAKARTA UNIT SYARIAH</option>
                                        <option value='ASURANSI TUGU PRATAMA INDONESIA'>ASURANSI TUGU PRATAMA INDONESIA</option>
                                        <option value='PAN PACIFIC SYARIAH INSURANCE'>PAN PACIFIC SYARIAH INSURANCE</option>
                                        <option value='PT ASURANSI JASINDO SYARIAH'>PT ASURANSI JASINDO SYARIAH</option>
                                        <option value='PT. ASURANSI UMUM MEGA UNIT SYARIAH'>PT. ASURANSI UMUM MEGA UNIT SYARIAH</option>
                                        <option value='SYARIAH BUMIDA'>SYARIAH BUMIDA</option>
                                        <option value='ZURICH GENERAL TAKAFUL INDONESIA'>ZURICH GENERAL TAKAFUL INDONESIA</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("Nama Paspor")}}</label>
                                    <input type="text" value="{{old('nama_paspor',$row->nama_paspor)}}" name="nama_paspor" placeholder="{{__("John Doe")}}" class="form-control form-control-sm">
                                    <i class="fa fa-user input-icon"></i>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("No Paspor")}}</label>
                                    <input type="text" value="{{old('no_paspor',$row->no_paspor)}}" name="no_paspor" placeholder="{{__("1A11A9189-XRS")}}" class="form-control form-control-sm">
                                    <i class="fa fa-id-card input-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Kota Paspor")}}</label>
                                    <input type="text" value="{{old('kota_paspor',$row->kota_paspor)}}" name="kota_paspor" placeholder="{{__("Jakarta")}}" class="form-control form-control-sm">
                                    <i class="fa fa-building input-icon"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Tanggal Dikeluarkan Paspor")}}</label>
                                    <input type="text" value="{{ old('tgl_release_paspor',($row->tgl_release_paspor and ($row->tgl_expired_paspor != '0000-00-00')) ? display_date($row->tgl_release_paspor) :'') }}" name="tgl_release_paspor" placeholder="" class="form-control form-control-sm date-picker">
                                    <i class="fa fa-calendar input-icon"></i>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Tanggal Habis Paspor")}}</label>
                                    <input type="text" value="{{ old('tgl_expired_paspor',($row->tgl_expired_paspor and ($row->tgl_expired_paspor != '0000-00-00'))? display_date($row->tgl_expired_paspor) :'') }}" name="tgl_expired_paspor" placeholder="" class="form-control form-control-sm date-picker">
                                    <i class="fa fa-calendar input-icon"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Pernah Pergi Umrah?")}}</label>
                                    <div>
                                        <input @if($row->umrah_ever=='ya') checked @endif type="radio" name="umrah_ever" value="ya"> {{__("Ya")}}
                                        <input @if($row->umrah_ever=='tidak') checked @endif type="radio" name="umrah_ever" value="tidak" checked> {{__("Tidak")}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Pernah Pergi Haji?")}}</label>
                                    <div>
                                        <input @if($row->haji_ever=='ya') checked @endif type="radio" name="haji_ever" value="ya"> {{__("Ya")}}
                                        <input @if($row->haji_ever=='tidak') checked @endif type="radio" name="haji_ever" value="tidak" checked> {{__("Tidak")}}
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{__("Kebutuhan Fasilitas Kursi Roda")}} <span class="text-danger">*</span></label>
                                    <div>
                                        <input @if($row->wheelchair_facilities=='ya') checked @endif type="radio" name="wheelchair_facilities" value="ya"> {{__("Ya")}}
                                        <input @if($row->wheelchair_facilities=='tidak') checked @endif type="radio" name="wheelchair_facilities" value="tidak" checked> {{__("Tidak")}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("Foto")}} <span class="text-danger">*</span></label>
                                    <div class="upload-btn-wrapper upload-foto">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file btn-foto">
                                                    {{__("Browse")}}… <input type="file" accept=".png, .jpg, .jpeg">
                                                </span>
                                            </span>
                                            <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view text-foto" readonly value="{{ get_file_url( old('avatar_id',$row->avatar_id) ) ?? $row->getAvatarUrl()?? __("No Image")}}">
                                        </div>
                                        <input type="hidden" class="form-control" name="avatar_id" value="{{ old('avatar_id',$row->avatar_id)?? ""}}">
                                        <img class="image-demo image-foto" src="{{ get_file_url( old('avatar_id',$row->avatar_id) ) ??  $row->getAvatarUrl() ?? ""}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("KTP")}} <span class="text-danger">*</span></label>
                                    <div class="upload-btn-wrapper upload-ktp">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file btn-ktp">
                                                    {{__("Browse")}}… <input type="file" accept=".png, .jpg, .jpeg">
                                                </span>
                                            </span>
                                            <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view text-ktp" readonly value="{{ get_file_url( old('idcard_id',$row->idcard_id) ) ?? $row->getIdcardUrl()?? __("No Image")}}">
                                        </div>
                                        <input type="hidden" class="form-control" name="idcard_id" value="{{ old('idcard_id',$row->idcard_id)?? ""}}">
                                        <img class="image-demo image-ktp" src="{{ get_file_url( old('idcard_id',$row->idcard_id) ) ??  $row->getIdcardUrl() ?? ""}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="form-row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("Kartu Keluarga")}} <span class="text-danger">*</span></label>
                                    <div class="upload-btn-wrapper upload-kk">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file btn-kk">
                                                    {{__("Browse")}}… <input type="file" accept=".png, .jpg, .jpeg">
                                                </span>
                                            </span>
                                            <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view text-kk" readonly value="{{ get_file_url( old('familycard_id',$row->familycard_id) ) ?? $row->getFamilycardUrl()?? __("No Image")}}">
                                        </div>
                                        <input type="hidden" class="form-control" name="familycard_id" value="{{ old('familycard_id',$row->familycard_id)?? ""}}">
                                        <img class="image-demo image-kk" src="{{ get_file_url( old('familycard_id',$row->familycard_id) ) ??  $row->getFamilycardUrl() ?? ""}}"/>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>{{__("Paspor")}}</label>
                                    <div class="upload-btn-wrapper upload-paspor">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <span class="btn btn-default btn-file btn-paspor">
                                                    {{__("Browse")}}… <input type="file" accept=".png, .jpg, .jpeg">
                                                </span>
                                            </span>
                                            <input type="text" data-error="{{__("Error upload...")}}" data-loading="{{__("Loading...")}}" class="form-control text-view text-paspor" readonly value="{{ get_file_url( old('passport_id',$row->passport_id) ) ?? $row->getPassportUrl()?? __("No Image")}}">
                                        </div>
                                        <input type="hidden" class="form-control" name="passport_id" value="{{ old('passport_id',$row->passport_id)?? ""}}">
                                        <img class="image-demo image-paspor" src="{{ get_file_url( old('passport_id',$row->passport_id) ) ??  $row->getPassportUrl() ?? ""}}"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="col-md-12">
                    <a class="btn btn-danger btn-sm" href="{{ route('vendor.team.index') }}">
                        <i class="fa fa-backward"></i> {{__('Batal')}}
                    </a>
                    <button class="btn btn-success btn-sm" type="submit">
                        <i class="fa fa-save"></i> {{__('Simpan')}}
                    </button>
                </div>
                </div>
            </form>
        </div>
    </div>
@endsection
@push('js')
<script>
    jQuery(function ($) {
        $('select.sel-provinsi').select2();
        $('select.provider').select2();
        $('select.asuransi').select2();
        $('select.sel-kabupaten').select2();
        $('select.sel-kecamatan').select2();
        $('select.sel-provinsi').on('change', function() {
            var selDest = $('.sel-kabupaten');
            onChangeSelect('{{ route('user.getForKabSelect2') }}', $(this).val(),selDest);
        });

        $('select.sel-kabupaten').on('change', function() {
            var selDest = $('.sel-kecamatan');
            onChangeSelect('{{ route('user.getForKecSelect2') }}', $(this).val(),selDest);
        });
    })

    function onChangeSelect(url, id, selDest) {
        $.ajax({
            url: url,
            type: 'GET',
            data: {
                id: id
            },
            success: function(data) {
                selDest.empty();
                selDest.append('<option>Silahkan Pilih</option>');

                var sel_content = '';
                $.each(data.results, function(key, value) {
                    sel_content += '<option value="' + value.id + '">' + value.text + '</option>';
                });
                selDest.append(sel_content);
                selDest.select2();
            }
        });
        }
</script>
@endpush