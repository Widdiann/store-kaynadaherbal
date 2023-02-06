<ul class="list-group">
    <li class="list-group-item" aria-current="true">
        <li class="list-group-item">
            <a
            href="{{ route('user.index') }}"
            
              style="cursor: pointer"
              class="list-group-item text-decoration-none  text-uppercase {{ setActive('user') }}"
              ><i class="fas fa-tachometer-alt"></i> Dashboard</a
            >
          </li>
    <li class="list-group-item">
        <a
            href="{{ route('transactions.user.index') }}"
          style="cursor: pointer"
          class="list-group-item text-decoration-none  text-uppercase {{ setActive('user/transactions' . '*') }}"
          ><i class="fas fa-dollar-sign"></i> Transaction</a
        >
      </li>
      <li class="list-group-item">
        <a
        href="{{ route('setting.user.index') }}"

          style="cursor: pointer"
          class="list-group-item text-decoration-none {{ setActive('user/setting' . '*') }} text-uppercase"
          ><i class="fas fa-user-alt"></i> Setting</a
        >
      </li>
    <li class="list-group-item">
      <a
      onclick="event.preventDefault();
                             document.getElementById('logout-form').submit();"
        style="cursor: pointer"
        class="list-group-item text-decoration-none text-dark text-uppercase"
        ><i class="fas fa-sign-out-alt"></i> Logout</a
      >
      <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
        @csrf
    </form>
    </li>
</ul>   