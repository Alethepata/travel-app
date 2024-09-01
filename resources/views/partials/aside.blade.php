<aside>
    <div class="container pt-3">
        <ul>
            <li>
                <i class="fa-solid fa-chart-line"></i>
                <a class="ms-2" href="{{ route('dashboard')}}">Dashboard</a>
            </li>
            <li>
                <i class="fa-regular fa-square-plus"></i>
                <a class="ms-2" href="{{ route('admin.days.create')}}">Crea viaggio</a>
            </li>
            <li>
                <i class="fa-solid fa-map-location-dot"></i>
                <a class="ms-2" href="{{ route('admin.days.index')}}">Il mio viaggio</a>
            </li>
            <li>
                <i class="fa-solid fa-plane"></i>
                <a class="ms-2" href="{{ route('admin.stages.create')}}">Pianifica</a>
            </li>
        </ul>
    </div>
</aside>
