<aside id="sidebar" class="sidebar">

    @if (checkRole('admin'))
        <ul class="sidebar-nav" id="sidebar-nav">

            <li class="nav-item">
                <a class="nav-link " href="index.html">
                    <i class="bi bi-grid"></i>
                    <span>Dashboard</span>
                </a>
            </li><!-- End Dashboard Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-menu-button-wide"></i><span>Subjects</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('subject.index') }}">
                            <i class="bi bi-circle"></i><span>View All Subject</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('subject.create') }}">
                            <i class="bi bi-circle"></i><span>Add New Subject</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Components Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#forms-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-journal-text"></i><span>Class</span><i class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="forms-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('class.index') }}">
                            <i class="bi bi-circle"></i><span>View All Class</span>
                        </a>
                    </li>
                    <li>
                        <a href="forms-layouts.html">
                            <i class="bi bi-circle"></i><span>Add New Class</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Forms Nav -->

            <li class="nav-item">
                <a class="nav-link collapsed" data-bs-target="#tables-nav" data-bs-toggle="collapse" href="#">
                    <i class="bi bi-layout-text-window-reverse"></i><span>Admin Users</span><i
                        class="bi bi-chevron-down ms-auto"></i>
                </a>
                <ul id="tables-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                    <li>
                        <a href="{{ route('user.index') }}">
                            <i class="bi bi-circle"></i><span>View All User</span>
                        </a>
                    </li>
                    <li>
                        <a href="tables-data.html">
                            <i class="bi bi-circle"></i><span>Add New User</span>
                        </a>
                    </li>
                </ul>
            </li><!-- End Tables Nav -->

        </ul>
    @elseif(checkRole('teacher'))
        @if (request()->is('teacher/my-students/*'))
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('teacher.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Back To Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-item">
                    <a class="nav-link " href="{{ route('teacher.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>My Students</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-item">
                    <a class="nav-link " href="{{ route('teacher.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Live Class</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-item">
                    <a class="nav-link " href="{{ route('teacher.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Quiz</span>
                    </a>
                </li><!-- End Dashboard Nav -->
            </ul>
        @else
            <ul class="sidebar-nav" id="sidebar-nav">
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('teacher.dashboard') }}">
                        <i class="bi bi-grid"></i>
                        <span>Dashboard</span>
                    </a>
                </li><!-- End Dashboard Nav -->

                <li class="nav-item">
                    <a class="nav-link collapsed" data-bs-target="#components-nav" data-bs-toggle="collapse"
                        href="#">
                        <i class="bi bi-menu-button-wide"></i><span>Quiz</span><i
                            class="bi bi-chevron-down ms-auto"></i>
                    </a>
                    <ul id="components-nav" class="nav-content collapse " data-bs-parent="#sidebar-nav">
                        <li>
                            <a href="{{ route('quiz.quiz-list') }}">
                                <i class="bi bi-circle"></i><span>View All Quiz</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('subject.create') }}">
                                <i class="bi bi-circle"></i><span>Add New Quiz</span>
                            </a>
                        </li>
                    </ul>
                </li><!-- End Components Nav -->
            </ul>
        @endif
    @elseif(checkRole('student'))
    <ul class="sidebar-nav" id="sidebar-nav">

        <li class="nav-item">
            <a class="nav-link " href="{{ route('student.dashboard') }}">
                <i class="bi bi-grid"></i>
                <span>Dashboard</span>
            </a>
        </li><!-- End Dashboard Nav -->

    </ul>
    @endif

</aside>
