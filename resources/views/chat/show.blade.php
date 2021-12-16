@extends('layouts.app')
@push('styles')
    <style>
        #users>li {
            cursor: pointer;
        }

    </style>
@endpush

@section('content')
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Chat</div>

                    <div class="card-body">
                        <div class="row p-2">
                            <div class="col-md-10">
                                <div class="row">
                                    <div class="col-12 border rouded-lg p-3">
                                        <ul id="messages" class="list-unstyled overflow-auto" style="height: 45vh;">

                                        </ul>
                                        <form>

                                            <div class="row py-3">
                                                <div class="col-sm-10">
                                                    <input type="text" id="message" class="form-control">
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" id="send" class="btn btn-primary btn-block">
                                                        Send
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-2">
                                <p><strong>Online Now</strong></p>
                                <ul id="users" class="list-unstyled overflow-auto text-info" style="height: 45vh;">

                                </ul>
                            </div>

                        </div>


                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        const usersElement = document.getElementById('users');
        const messagesElement = document.getElementById('messages');

        Echo.join('chat')
            .here((users) => {
                users.forEach((user, index) => {
                    let element = document.createElement('li');

                    element.setAttribute('id', user.id);
                    element.setAttribute('onclick', `greetUser('${user.id}')`);
                    element.innerText = user.name;

                    usersElement.appendChild(element);
                });
            })
            .joining((user) => {
                let element = document.createElement('li');

                element.setAttribute('id', user.id);
                element.setAttribute('onclick', `greetUser('${user.id}')`);
                element.innerText = user.name;

                usersElement.appendChild(element);

            })
            .leaving((user) => {
                let element = document.getElementById(user.id);
                element.parentNode.removeChild(element);
            })
            .listen('MessageSent', (e) => {
                let element = document.createElement('li');

                element.setAttribute('id', e.user.id);
                element.innerText = e.user.name + ': ' + e.message;

                messagesElement.appendChild(element)

            });
    </script>

    <script>
        const sendElement = document.getElementById('send');
        const messageElement = document.getElementById('message');

        sendElement.addEventListener('click', (e) => {
            e.preventDefault();
            window.axios.post('/chat/message', {
                message: messageElement.value
            });
            messageElement.value = '';


        });
    </script>

    <script>
        function greetUser(id) {
            window.axios.post('/chat/greet/' + id);
        }
    </script>

    <script>
        Echo.private('chat.greet.{{ auth()->user()->id }}')
            .listen('GreetingSent', (e) => {
                let element = document.createElement('li');

                element.innerText =  e.message;
                element.classList.add('text-success');

                messagesElement.appendChild(element)
            });
    </script>
@endpush
