@extends('admin.layouts.admin_dashboard')

@section('title', 'Diaconate Attendance - Admin Dashboard')

@section('admin')
    <div class="page-content">
            <div class="row row-cols-3">
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-info">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Total Users</p>
                                <h4 class="my-1 text-info">{{ $totalUsers }}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-blues text-white ms-auto"><i class='bx bxs-group'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-danger">
                <div class="card-body">
                    <div class="d-flex align-items-center">
                        <div>
                            <p class="mb-0 text-secondary">Total Attendance Count</p>
                            <h4 class="my-1 text-danger">{{ $totalAttendanceCount }}</h4>
                        </div>
                        <div class="widgets-icons-2 rounded-circle bg-gradient-burning text-white ms-auto"><i class='bx bxs-calendar-check'></i>
                        </div>
                    </div>
                </div>
                </div>
            </div>
            <div class="col">
                <div class="card radius-10 border-start border-0 border-4 border-success">
                    <div class="card-body">
                        <div class="d-flex align-items-center">
                            <div>
                                <p class="mb-0 text-secondary">Today's Attendance Count</p>
                                <h4 class="my-1 text-success">{{ $todaysAttendanceCount }}</h4>
                            </div>
                            <div class="widgets-icons-2 rounded-circle bg-gradient-ohhappiness text-white ms-auto"><i class='bx bxs-calendar-event'></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 d-flex">
               <div class="card radius-10 w-100">
                 <div class="card-header">
                     <div class="d-flex align-items-center">
                         <div>
                             <h6 class="mb-0">Overview</h6>
                         </div>
                     </div>
                 </div>
                   <div class="card-body">                     
                     <div class="col-12 h-auto">
                        <canvas id="userChart"></canvas>
                       </div>
                   </div>
               </div>
            </div>
         </div><!--end row-->

    </div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const userChartCtx = document.getElementById('userChart').getContext('2d');
        const userChart = new Chart(userChartCtx, {
            type: 'bar',
            data: {
                labels: @json($allDates),
                datasets: [
                    {
                        label: 'Number of Users',
                        data: @json($userCounts),
                        borderColor: 'rgba(54, 162, 235, 1)',
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        // borderWidth: 1,
                        pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(54, 162, 235, 1)',
                        tension: 0.4
                    },
                    {
                        label: 'Attendance Records',
                        data: @json($attendanceCounts),
                        borderColor: 'rgba(75, 192, 192, 1)',
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        // borderWidth: 2,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointBorderColor: '#fff',
                        pointHoverBackgroundColor: '#fff',
                        pointHoverBorderColor: 'rgba(75, 192, 192, 1)',
                        tension: 0.4  // Wavy effect
                    }
                ]
            },
            options: {
                scales: {
                    responsive: true,
                    maintainAspectRatio: false,
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 1
                        }
                    }
                }
            }
        });
    </script>
@endpush