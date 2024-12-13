<?php

use Core\Session;

Session::destroy();

redirect('/login');
