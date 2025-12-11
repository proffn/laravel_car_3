@extends('layouts.app')

@section('title', 'Автомобили от владельцев')

@section('content')
<div class="text-center mb-5">
    <h1 class="display-4 text-muted fw-light" style="font-family: 'Play', sans-serif;">
        Автомобили от владельцев
    </h1>
</div>

<div class="row g-4 justify-content-center">
    <!-- Toyota Camry -->
    <div class="col-xxxl-3 col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="card shadow-sm border-0 rounded-4 h-100 position-relative overflow-hidden car-card"
             data-car="camry1">
            <div class="position-absolute top-0 start-0 m-2 px-2 py-1 bg-primary text-white rounded fw-semibold small shadow-sm">
                Седан
            </div>
            <img src="{{ asset('images/1200x900.png') }}" class="card-img-top img-fluid" alt="Toyota Camry">
            <div class="card-body bg-light-subtle">
                <small class="text-muted">Toyota Camry</small>
                <h5 class="card-title fw-bold mb-2">Тойота Камри</h5>
                <p class="card-text text-muted">
                    <strong>Год:</strong> 2018<br>
                    <strong>Пробег:</strong> 85 000 км<br>
                    <strong>Цвет:</strong> Белый
                </p>
            </div>
        </div>
    </div>

    <!-- Ford Focus -->
    <div class="col-xxxl-3 col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="card shadow-sm border-0 rounded-4 h-100 position-relative overflow-hidden car-card"
             data-car="focus1">
            <div class="position-absolute top-0 start-0 m-2 px-2 py-1 bg-primary text-white rounded fw-semibold small shadow-sm">
                Универсал
            </div>
            <img src="{{ asset('images/320x240.png') }}" class="card-img-top img-fluid" alt="Ford Focus">
            <div class="card-body bg-light-subtle">
                <small class="text-muted">Ford Focus</small>
                <h5 class="card-title fw-bold mb-2">Форд Фокус</h5>
                <p class="card-text text-muted">
                    <strong>Год:</strong> 2017<br>
                    <strong>Пробег:</strong> 120 000 км<br>
                    <strong>Цвет:</strong> Белый
                </p>
            </div>
        </div>
    </div>

    <!-- Honda Civic -->
    <div class="col-xxxl-3 col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="card shadow-sm border-0 rounded-4 h-100 position-relative overflow-hidden car-card"
             data-car="civic1">
            <div class="position-absolute top-0 start-0 m-2 px-2 py-1 bg-primary text-white rounded fw-semibold small shadow-sm">
                Хэтчбек
            </div>
            <img src="{{ asset('images/456x342.png') }}" class="card-img-top img-fluid" alt="Honda Civic">
            <div class="card-body bg-light-subtle">
                <small class="text-muted">Honda Civic</small>
                <h5 class="card-title fw-bold mb-2">Хонда Цивик</h5>
                <p class="card-text text-muted">
                    <strong>Год:</strong> 2019<br>
                    <strong>Пробег:</strong> 45 000 км<br>
                    <strong>Цвет:</strong> Синий
                </p>
            </div>
        </div>
    </div>

    <!-- BMW X3 -->
    <div class="col-xxxl-3 col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="card shadow-sm border-0 rounded-4 h-100 position-relative overflow-hidden car-card"
             data-car="x3">
            <div class="position-absolute top-0 start-0 m-2 px-2 py-1 bg-primary text-white rounded fw-semibold small shadow-sm">
                Внедорожник
            </div>
            <img src="{{ asset('images/456x3424.png') }}" class="card-img-top img-fluid" alt="BMW X3">
            <div class="card-body bg-light-subtle">
                <small class="text-muted">BMW X3</small>
                <h5 class="card-title fw-bold mb-2">БМВ Х3</h5>
                <p class="card-text text-muted">
                    <strong>Год:</strong> 2020<br>
                    <strong>Пробег:</strong> 35 000 км<br>
                    <strong>Цвет:</strong> Черный
                </p>
            </div>
        </div>
    </div>

    <!-- Volkswagen Golf -->
    <div class="col-xxxl-3 col-xxl-3 col-xl-4 col-lg-6 col-md-6 col-sm-12">
        <div class="card shadow-sm border-0 rounded-4 h-100 position-relative overflow-hidden car-card"
             data-car="golf">
            <div class="position-absolute top-0 start-0 m-2 px-2 py-1 bg-primary text-white rounded fw-semibold small shadow-sm">
                Хэтчбек
            </div>
            <img src="{{ asset('images/4456x342.png') }}" class="card-img-top img-fluid" alt="Volkswagen Golf">
            <div class="card-body bg-light-subtle">
                <small class="text-muted">Volkswagen Golf</small>
                <h5 class="card-title fw-bold mb-2">Фольксваген Гольф</h5>
                <p class="card-text text-muted">
                    <strong>Год:</strong> 2016<br>
                    <strong>Пробег:</strong> 95 000 км<br>
                    <strong>Цвет:</strong> Серебристый
                </p>
            </div>
        </div>
    </div>
</div>
@endsection