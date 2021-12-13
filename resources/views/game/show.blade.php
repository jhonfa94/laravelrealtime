@extends('layouts.app')

@push('styles')
    <style>
        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .refresh {
            animation: rotate 1.5s linear infinite;
        }

    </style>
@endpush

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">
                        <div class="text-center">
                            <img id="circle" width="250" height="250" src="{{ asset('img/circle.png') }}"
                                class="img-fluid ">
                            <p id="winner" class="display-1 d-none text-primary"></p>
                        </div>
                        <hr>
                        <div class="text-center">
                            <div class="form-group">
                                <label for="bet" class="font-weight-bold h5">your bet</label>
                                <select id="bet" class="form-control custom-select col-auto" name="">
                                    <option selected>Not in</option>
                                    @foreach (range(1, 12) as $number)
                                        <option>{{ $number }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <hr>
                            <p class="font-weight-bold h5">Remaing Time</p>
                            <p id="timer" class="h5 text-danger">Waiting to start</p>
                            <hr>
                            <p id="result" class="h1"></p>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const circleElement = document.getElementById('circle');
        const timerElement = document.getElementById('timer');
        const winnerElement = document.getElementById('winner');
        const betElement = document.getElementById('bet');
        const resultElement = document.getElementById('result');

        Echo.channel('game')
            .listen('RemainingTimeChange', (e) => {
                timerElement.innerText = e.time;
                circleElement.classList.add('refresh');

                winnerElement.classList.add('d-none');

                resultElement.innerText = '';

                winnerElement.classList.remove('text-success');
                winnerElement.classList.remove('text-danger');

            })
            .listen('WinnerNumberGenerated', (e) => {
                circleElement.classList.remove('refresh');
                let winner = e.number;
                winnerElement.innerText = winner;
                winnerElement.classList.remove('d-none');

                let bet = betElement[betElement.selectedIndex].innerText;

                if (bet == winner) {
                    resultElement.innerText = 'You WIN';
                    resultElement.classList.add('text-success');
                } else {
                    resultElement.innerText = 'You LOSE';
                    resultElement.classList.add('text-danger');

                }

            })
    </script>
@endpush
