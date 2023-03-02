@php
    $url = url('');
    if (auth()->user()->role_id == 1) {
        $url = url('teknisi');
    }
@endphp
<nav class="navbar-wrap">
    <div class="menubar-footer">
        <a href="{{ url('/') }}">
            <button class="btn-menubar">
                <svg fill="#000000" height="22" width="22" version="1.1" id="Layer_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                    xml:space="preserve">
                    <g>
                        <g>
                            <path
                                d="M256,2.938l-256,256v48.427h62.061v201.697h155.152V384.941h77.576v124.121h155.151V307.365H512v-48.427L256,2.938z
                                M403.394,260.82v201.697h-62.061V338.396H170.667v124.121h-62.061V260.82H63.943L256,68.762L448.057,260.82H403.394z" />
                        </g>
                    </g>
                </svg>
                <span style="color: #000; font-size: 10px">Home</span>
            </button>
        </a>
        <a href="{{ url('transaksi') }}">
            <button class="btn-menubar">
                <svg width="22" height="22" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path d="M9 17H20M9 12H20M9 7H20M4 16.5H5V17.5H4V16.5ZM4 11.5H5V12.5H4V11.5ZM4 6.5V7.5H5V6.5H4Z"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span style="color: #000; font-size: 10px">Transaction</span>
            </button>
        </a>
        <a href="{{ url('akun') }}">
            <button class="btn-menubar">
                <svg fill="#000000" height="22" width="22" version="1.1" id="Layer_1"
                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                    xml:space="preserve">
                    <g>
                        <g>
                            <path
                                d="M448.596,329.999c-25.273-26.645-55.64-46.029-87.621-56.586c31.865-28.738,51.928-70.322,51.928-116.51
                                C412.903,70.387,342.516,0,256,0S99.097,70.387,99.097,156.903c0,46.187,20.064,87.772,51.928,116.511
                                c-31.984,10.557-62.348,29.94-87.621,56.586C22.518,373.106,0,428.944,0,487.226V512h512v-24.774
                                C512,428.944,489.482,373.106,448.596,329.999z M148.645,156.903c0-59.195,48.159-107.355,107.355-107.355
                                c59.195,0,107.355,48.159,107.355,107.355c0,59.195-48.159,107.355-107.355,107.355
                                C196.805,264.258,148.645,216.099,148.645,156.903z M51.292,462.452c12.298-86.569,87.398-148.645,155.159-148.645h99.097
                                c67.759,0,142.861,62.076,155.159,148.645H51.292z" />
                        </g>
                    </g>
                </svg>
                <span style="color: #000; font-size: 10px">Account</span>
            </button>
        </a>
        <a href="{{ route('logout') }}">
            <button class="btn-menubar">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                    xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M14 7.63636L14 4.5C14 4.22386 13.7761 4 13.5 4L4.5 4C4.22386 4 4 4.22386 4 4.5L4 19.5C4 19.7761 4.22386 20 4.5 20L13.5 20C13.7761 20 14 19.7761 14 19.5L14 16.3636"
                        stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                    <path d="M10 12L21 12M21 12L18.0004 8.5M21 12L18 15.5" stroke="#000000" stroke-width="2"
                        stroke-linecap="round" stroke-linejoin="round" />
                </svg>
                <span style="color: #000; font-size: 10px">Logout</span>
            </button>
        </a>
    </div>
</nav>
