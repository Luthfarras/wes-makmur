@extends('template')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <form action="{{ route('jamu.store') }}" method="post">
                        @csrf
                        <div class="mb-3">
                            <label for="" class="form-label">Keluhan</label>
                            <select name="keluhan" class="form-select" id="">
                                <option selected disabled>Pilih Keluhan Anda..</option>
                                <option value="keseleo">Keseleo</option>
                                <option value="kurang nafsu makan">Kurang nafsu makan</option>
                                <option value="pegal-pegal">Pegal-pegal</option>
                                <option value="gula darah">Gula darah</option>
                                <option value="darah tinggi">Darah tinggi</option>
                                <option value="kram perut">Kram perut</option>
                                <option value="masuk angin">Masuk angin</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">Tahun Lahir</label>
                            <select name="tahunLahir" class="form-select" id="">
                                <option selected disabled>Pilih Tahun Lahir Anda..</option>
                                @for ($i = 1950; $i <= date('Y'); $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                                @endfor                                
                            </select>
                        </div>
                        <button type="submit" class="btn btn-outline-info" style="border-radius: 50px">Cek Rekomendasi</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Data</th>
                                    <th>Hasil</th>
                                </tr>
                            </thead>
                            <tbody>
                                @isset($data)
                                <tr>
                                    <th>Nama Jamu</th>
                                    <td>{{ $data['nama'] }}</td>
                                </tr>
                                <tr>
                                    <th>Khasiat</th>
                                    <td>{{ $data['khasiat'] }}</td>
                                </tr>
                                <tr>
                                    <th>Keluhan</th>
                                    <td>{{ $data['keluhan'] }}</td>
                                </tr>
                                <tr>
                                    <th>Umur</th>
                                    <td>{{ $data['umur'] }}</td>
                                </tr>
                                <tr>
                                    <th>Saran Penggunaan</th>
                                    <td>{{ $data['saran'] }}</td>
                                </tr>
                                    
                                @endisset
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection