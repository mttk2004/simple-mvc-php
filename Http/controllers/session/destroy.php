<?php

use Core\Session;

Session::destroy();

return redirect('/login');
