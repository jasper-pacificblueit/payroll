@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="wrapper wrapper-content">
  <div class="row">
              <div class="col-lg-3">
                  <div class="ibox float-e-margins">
                      <div class="ibox-title">
                          <span class="label label-success pull-right">Monthly</span>
                          <h5>Income</h5>
                      </div>
                      <div class="ibox-content">
                          <h1 class="no-margins">40 886,200</h1>
                          <div class="stat-percent font-bold text-success">98% <i class="fa fa-bolt"></i></div>
                          <small>Total income</small>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3">
                  <div class="ibox float-e-margins">
                      <div class="ibox-title">
                          <span class="label label-info pull-right">Annual</span>
                          <h5>Orders</h5>
                      </div>
                      <div class="ibox-content">
                          <h1 class="no-margins">275,800</h1>
                          <div class="stat-percent font-bold text-info">20% <i class="fa fa-level-up"></i></div>
                          <small>New orders</small>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3">
                  <div class="ibox float-e-margins">
                      <div class="ibox-title">
                          <span class="label label-primary pull-right">Today</span>
                          <h5>visits</h5>
                      </div>
                      <div class="ibox-content">
                          <h1 class="no-margins">106,120</h1>
                          <div class="stat-percent font-bold text-navy">44% <i class="fa fa-level-up"></i></div>
                          <small>New visits</small>
                      </div>
                  </div>
              </div>
              <div class="col-lg-3">
                  <div class="ibox float-e-margins">
                      <div class="ibox-title">
                          <span class="label label-danger pull-right">Low value</span>
                          <h5>User activity</h5>
                      </div>
                      <div class="ibox-content">
                          <h1 class="no-margins">80,600</h1>
                          <div class="stat-percent font-bold text-danger">38% <i class="fa fa-level-down"></i></div>
                          <small>In first month</small>
                      </div>
                  </div>
      </div>
  </div>
  <div class="row">
              <div class="col-lg-12">
                  <div class="ibox float-e-margins">
                      <div class="ibox-title">
                          <h5>Orders</h5>
                          <div class="pull-right">
                              <div class="btn-group">
                                  <button type="button" class="btn btn-xs btn-white active">Today</button>
                                  <button type="button" class="btn btn-xs btn-white">Monthly</button>
                                  <button type="button" class="btn btn-xs btn-white">Annual</button>
                              </div>
                          </div>
                      </div>
                      <div class="ibox-content">
                          <div class="row">
                          <div class="col-lg-9">
                              <div class="flot-chart">
                                  <div class="flot-chart-content" id="flot-dashboard-chart"></div>
                              </div>
                          </div>
                          <div class="col-lg-3">
                              <ul class="stat-list">
                                  <li>
                                      <h2 class="no-margins">2,346</h2>
                                      <small>Total orders in period</small>
                                      <div class="stat-percent">48% <i class="fa fa-level-up text-navy"></i></div>
                                      <div class="progress progress-mini">
                                          <div style="width: 48%;" class="progress-bar"></div>
                                      </div>
                                  </li>
                                  <li>
                                      <h2 class="no-margins ">4,422</h2>
                                      <small>Orders in last month</small>
                                      <div class="stat-percent">60% <i class="fa fa-level-down text-navy"></i></div>
                                      <div class="progress progress-mini">
                                          <div style="width: 60%;" class="progress-bar"></div>
                                      </div>
                                  </li>
                                  <li>
                                      <h2 class="no-margins ">9,180</h2>
                                      <small>Monthly income from orders</small>
                                      <div class="stat-percent">22% <i class="fa fa-bolt text-navy"></i></div>
                                      <div class="progress progress-mini">
                                          <div style="width: 22%;" class="progress-bar"></div>
                                      </div>
                                  </li>
                                  </ul>
                              </div>
                          </div>
                          </div>

                      </div>
                  </div>
              </div>


          <div class="row">
              <div class="col-lg-4">
                  <div class="ibox float-e-margins">
                      <div class="ibox-title">
                          <h5>Messages</h5>
                          <div class="ibox-tools">
                              <a class="collapse-link">
                                  <i class="fa fa-chevron-up"></i>
                              </a>
                              <a class="close-link">
                                  <i class="fa fa-times"></i>
                              </a>
                          </div>
                      </div>
                      <div class="ibox-content ibox-heading">
                          <h3><i class="fa fa-envelope-o"></i> New messages</h3>
                          <small><i class="fa fa-tim"></i> You have 22 new messages and 16 waiting in draft folder.</small>
                      </div>
                      <div class="ibox-content">
                          <div class="feed-activity-list">

                              <div class="feed-element">
                                  <div>
                                      <small class="pull-right text-navy">1m ago</small>
                                      <strong>Monica Smith</strong>
                                      <div>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum</div>
                                      <small class="text-muted">Today 5:60 pm - 12.06.2014</small>
                                  </div>
                              </div>

                              <div class="feed-element">
                                  <div>
                                      <small class="pull-right">2m ago</small>
                                      <strong>Jogn Angel</strong>
                                      <div>There are many variations of passages of Lorem Ipsum available</div>
                                      <small class="text-muted">Today 2:23 pm - 11.06.2014</small>
                                  </div>
                              </div>

                              <div class="feed-element">
                                  <div>
                                      <small class="pull-right">5m ago</small>
                                      <strong>Jesica Ocean</strong>
                                      <div>Contrary to popular belief, Lorem Ipsum</div>
                                      <small class="text-muted">Today 1:00 pm - 08.06.2014</small>
                                  </div>
                              </div>

                              <div class="feed-element">
                                  <div>
                                      <small class="pull-right">5m ago</small>
                                      <strong>Monica Jackson</strong>
                                      <div>The generated Lorem Ipsum is therefore </div>
                                      <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                  </div>
                              </div>


                              <div class="feed-element">
                                  <div>
                                      <small class="pull-right">5m ago</small>
                                      <strong>Anna Legend</strong>
                                      <div>All the Lorem Ipsum generators on the Internet tend to repeat </div>
                                      <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                  </div>
                              </div>
                              <div class="feed-element">
                                  <div>
                                      <small class="pull-right">5m ago</small>
                                      <strong>Damian Nowak</strong>
                                      <div>The standard chunk of Lorem Ipsum used </div>
                                      <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                  </div>
                              </div>
                              <div class="feed-element">
                                  <div>
                                      <small class="pull-right">5m ago</small>
                                      <strong>Gary Smith</strong>
                                      <div>200 Latin words, combined with a handful</div>
                                      <small class="text-muted">Yesterday 8:48 pm - 10.06.2014</small>
                                  </div>
                              </div>

                          </div>
                      </div>
                  </div>
              </div>

              <div class="col-lg-8">

                  <div class="row">
                      <div class="col-lg-6">
                          <div class="ibox float-e-margins">
                              <div class="ibox-title">
                                  <h5>User project list</h5>
                                  <div class="ibox-tools">
                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a class="close-link">
                                          <i class="fa fa-times"></i>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content">
                                  <table class="table table-hover no-margins">
                                      <thead>
                                      <tr>
                                          <th>Status</th>
                                          <th>Date</th>
                                          <th>User</th>
                                          <th>Value</th>
                                      </tr>
                                      </thead>
                                      <tbody>
                                      <tr>
                                          <td><small>Pending...</small></td>
                                          <td><i class="fa fa-clock-o"></i> 11:20pm</td>
                                          <td>Samantha</td>
                                          <td class="text-navy"> <i class="fa fa-level-up"></i> 24% </td>
                                      </tr>
                                      <tr>
                                          <td><span class="label label-warning">Canceled</span> </td>
                                          <td><i class="fa fa-clock-o"></i> 10:40am</td>
                                          <td>Monica</td>
                                          <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                      </tr>
                                      <tr>
                                          <td><small>Pending...</small> </td>
                                          <td><i class="fa fa-clock-o"></i> 01:30pm</td>
                                          <td>John</td>
                                          <td class="text-navy"> <i class="fa fa-level-up"></i> 54% </td>
                                      </tr>
                                      <tr>
                                          <td><small>Pending...</small> </td>
                                          <td><i class="fa fa-clock-o"></i> 02:20pm</td>
                                          <td>Agnes</td>
                                          <td class="text-navy"> <i class="fa fa-level-up"></i> 12% </td>
                                      </tr>
                                      <tr>
                                          <td><small>Pending...</small> </td>
                                          <td><i class="fa fa-clock-o"></i> 09:40pm</td>
                                          <td>Janet</td>
                                          <td class="text-navy"> <i class="fa fa-level-up"></i> 22% </td>
                                      </tr>
                                      <tr>
                                          <td><span class="label label-primary">Completed</span> </td>
                                          <td><i class="fa fa-clock-o"></i> 04:10am</td>
                                          <td>Amelia</td>
                                          <td class="text-navy"> <i class="fa fa-level-up"></i> 66% </td>
                                      </tr>
                                      <tr>
                                          <td><small>Pending...</small> </td>
                                          <td><i class="fa fa-clock-o"></i> 12:08am</td>
                                          <td>Damian</td>
                                          <td class="text-navy"> <i class="fa fa-level-up"></i> 23% </td>
                                      </tr>
                                      </tbody>
                                  </table>
                              </div>
                          </div>
                      </div>
                      <div class="col-lg-6">
                          <div class="ibox float-e-margins">
                              <div class="ibox-title">
                                  <h5>Small todo list</h5>
                                  <div class="ibox-tools">
                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a class="close-link">
                                          <i class="fa fa-times"></i>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content">
                                  <ul class="todo-list m-t small-list">
                                      <li>
                                          <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                                          <span class="m-l-xs todo-completed">Buy a milk</span>

                                      </li>
                                      <li>
                                          <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                          <span class="m-l-xs">Go to shop and find some products.</span>

                                      </li>
                                      <li>
                                          <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                          <span class="m-l-xs">Send documents to Mike</span>
                                          <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 mins</small>
                                      </li>
                                      <li>
                                          <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                          <span class="m-l-xs">Go to the doctor dr Smith</span>
                                      </li>
                                      <li>
                                          <a href="#" class="check-link"><i class="fa fa-check-square"></i> </a>
                                          <span class="m-l-xs todo-completed">Plan vacation</span>
                                      </li>
                                      <li>
                                          <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                          <span class="m-l-xs">Create new stuff</span>
                                      </li>
                                      <li>
                                          <a href="#" class="check-link"><i class="fa fa-square-o"></i> </a>
                                          <span class="m-l-xs">Call to Anna for dinner</span>
                                      </li>
                                  </ul>
                              </div>
                          </div>
                      </div>
                  </div>
                  <div class="row">
                      <div class="col-lg-12">
                          <div class="ibox float-e-margins">
                              <div class="ibox-title">
                                  <h5>Transactions worldwide</h5>
                                  <div class="ibox-tools">
                                      <a class="collapse-link">
                                          <i class="fa fa-chevron-up"></i>
                                      </a>
                                      <a class="close-link">
                                          <i class="fa fa-times"></i>
                                      </a>
                                  </div>
                              </div>
                              <div class="ibox-content">

                                  <div class="row">
                                      <div class="col-lg-6">
                                          <table class="table table-hover margin bottom">
                                              <thead>
                                              <tr>
                                                  <th style="width: 1%" class="text-center">No.</th>
                                                  <th>Transaction</th>
                                                  <th class="text-center">Date</th>
                                                  <th class="text-center">Amount</th>
                                              </tr>
                                              </thead>
                                              <tbody>
                                              <tr>
                                                  <td class="text-center">1</td>
                                                  <td> Security doors
                                                      </td>
                                                  <td class="text-center small">16 Jun 2014</td>
                                                  <td class="text-center"><span class="label label-primary">$483.00</span></td>

                                              </tr>
                                              <tr>
                                                  <td class="text-center">2</td>
                                                  <td> Wardrobes
                                                  </td>
                                                  <td class="text-center small">10 Jun 2014</td>
                                                  <td class="text-center"><span class="label label-primary">$327.00</span></td>

                                              </tr>
                                              <tr>
                                                  <td class="text-center">3</td>
                                                  <td> Set of tools
                                                  </td>
                                                  <td class="text-center small">12 Jun 2014</td>
                                                  <td class="text-center"><span class="label label-warning">$125.00</span></td>

                                              </tr>
                                              <tr>
                                                  <td class="text-center">4</td>
                                                  <td> Panoramic pictures</td>
                                                  <td class="text-center small">22 Jun 2013</td>
                                                  <td class="text-center"><span class="label label-primary">$344.00</span></td>
                                              </tr>
                                              <tr>
                                                  <td class="text-center">5</td>
                                                  <td>Phones</td>
                                                  <td class="text-center small">24 Jun 2013</td>
                                                  <td class="text-center"><span class="label label-primary">$235.00</span></td>
                                              </tr>
                                              <tr>
                                                  <td class="text-center">6</td>
                                                  <td>Monitors</td>
                                                  <td class="text-center small">26 Jun 2013</td>
                                                  <td class="text-center"><span class="label label-primary">$100.00</span></td>
                                              </tr>
                                              </tbody>
                                          </table>
                                      </div>
                                      <div class="col-lg-6">
                                          <div id="world-map" style="height: 300px;"></div>
                                      </div>
                              </div>
                              </div>
                          </div>
                      </div>
                  </div>

              </div>


          </div>
          </div>
  <div class="footer">
    @endsection
      </div>
  </div>
  </div>
  <div id="right-sidebar">
      <div class="sidebar-container">

          <ul class="nav nav-tabs navs-3">

              <li class="active"><a data-toggle="tab" href="#tab-1">
                  Notes
              </a></li>
              <li><a data-toggle="tab" href="#tab-2">
                  Projects
              </a></li>
              <li class=""><a data-toggle="tab" href="#tab-3">
                  <i class="fa fa-gear"></i>
              </a></li>
          </ul>

          <div class="tab-content">


              <div id="tab-1" class="tab-pane active">

                  <div class="sidebar-title">
                      <h3> <i class="fa fa-comments-o"></i> Latest Notes</h3>
                      <small><i class="fa fa-tim"></i> You have 10 new message.</small>
                  </div>

                  <div>

                      <div class="sidebar-message">
                          <a href="#">
                              <div class="pull-left text-center">
                                  <img alt="image" class="img-circle message-avatar" src="img/a1.jpg">

                                  <div class="m-t-xs">
                                      <i class="fa fa-star text-warning"></i>
                                      <i class="fa fa-star text-warning"></i>
                                  </div>
                              </div>
                              <div class="media-body">

                                  There are many variations of passages of Lorem Ipsum available.
                                  <br>
                                  <small class="text-muted">Today 4:21 pm</small>
                              </div>
                          </a>
                      </div>
                      <div class="sidebar-message">
                          <a href="#">
                              <div class="pull-left text-center">
                                  <img alt="image" class="img-circle message-avatar" src="img/a2.jpg">
                              </div>
                              <div class="media-body">
                                  The point of using Lorem Ipsum is that it has a more-or-less normal.
                                  <br>
                                  <small class="text-muted">Yesterday 2:45 pm</small>
                              </div>
                          </a>
                      </div>
                      <div class="sidebar-message">
                          <a href="#">
                              <div class="pull-left text-center">
                                  <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                                  <div class="m-t-xs">
                                      <i class="fa fa-star text-warning"></i>
                                      <i class="fa fa-star text-warning"></i>
                                      <i class="fa fa-star text-warning"></i>
                                  </div>
                              </div>
                              <div class="media-body">
                                  Mevolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                                  <br>
                                  <small class="text-muted">Yesterday 1:10 pm</small>
                              </div>
                          </a>
                      </div>
                      <div class="sidebar-message">
                          <a href="#">
                              <div class="pull-left text-center">
                                  <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                              </div>

                              <div class="media-body">
                                  Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the
                                  <br>
                                  <small class="text-muted">Monday 8:37 pm</small>
                              </div>
                          </a>
                      </div>
                      <div class="sidebar-message">
                          <a href="#">
                              <div class="pull-left text-center">
                                  <img alt="image" class="img-circle message-avatar" src="img/a8.jpg">
                              </div>
                              <div class="media-body">

                                  All the Lorem Ipsum generators on the Internet tend to repeat.
                                  <br>
                                  <small class="text-muted">Today 4:21 pm</small>
                              </div>
                          </a>
                      </div>
                      <div class="sidebar-message">
                          <a href="#">
                              <div class="pull-left text-center">
                                  <img alt="image" class="img-circle message-avatar" src="img/a7.jpg">
                              </div>
                              <div class="media-body">
                                  Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.
                                  <br>
                                  <small class="text-muted">Yesterday 2:45 pm</small>
                              </div>
                          </a>
                      </div>
                      <div class="sidebar-message">
                          <a href="#">
                              <div class="pull-left text-center">
                                  <img alt="image" class="img-circle message-avatar" src="img/a3.jpg">

                                  <div class="m-t-xs">
                                      <i class="fa fa-star text-warning"></i>
                                      <i class="fa fa-star text-warning"></i>
                                      <i class="fa fa-star text-warning"></i>
                                  </div>
                              </div>
                              <div class="media-body">
                                  The standard chunk of Lorem Ipsum used since the 1500s is reproduced below.
                                  <br>
                                  <small class="text-muted">Yesterday 1:10 pm</small>
                              </div>
                          </a>
                      </div>
                      <div class="sidebar-message">
                          <a href="#">
                              <div class="pull-left text-center">
                                  <img alt="image" class="img-circle message-avatar" src="img/a4.jpg">
                              </div>
                              <div class="media-body">
                                  Uncover many web sites still in their infancy. Various versions have.
                                  <br>
                                  <small class="text-muted">Monday 8:37 pm</small>
                              </div>
                          </a>
                      </div>
                  </div>

              </div>

              <div id="tab-2" class="tab-pane">

                  <div class="sidebar-title">
                      <h3> <i class="fa fa-cube"></i> Latest projects</h3>
                      <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                  </div>

                  <ul class="sidebar-list">
                      <li>
                          <a href="#">
                              <div class="small pull-right m-t-xs">9 hours ago</div>
                              <h4>Business valuation</h4>
                              It is a long established fact that a reader will be distracted.

                              <div class="small">Completion with: 22%</div>
                              <div class="progress progress-mini">
                                  <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                              </div>
                              <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <div class="small pull-right m-t-xs">9 hours ago</div>
                              <h4>Contract with Company </h4>
                              Many desktop publishing packages and web page editors.

                              <div class="small">Completion with: 48%</div>
                              <div class="progress progress-mini">
                                  <div style="width: 48%;" class="progress-bar"></div>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <div class="small pull-right m-t-xs">9 hours ago</div>
                              <h4>Meeting</h4>
                              By the readable content of a page when looking at its layout.

                              <div class="small">Completion with: 14%</div>
                              <div class="progress progress-mini">
                                  <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <span class="label label-primary pull-right">NEW</span>
                              <h4>The generated</h4>
                              <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                              There are many variations of passages of Lorem Ipsum available.
                              <div class="small">Completion with: 22%</div>
                              <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <div class="small pull-right m-t-xs">9 hours ago</div>
                              <h4>Business valuation</h4>
                              It is a long established fact that a reader will be distracted.

                              <div class="small">Completion with: 22%</div>
                              <div class="progress progress-mini">
                                  <div style="width: 22%;" class="progress-bar progress-bar-warning"></div>
                              </div>
                              <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <div class="small pull-right m-t-xs">9 hours ago</div>
                              <h4>Contract with Company </h4>
                              Many desktop publishing packages and web page editors.

                              <div class="small">Completion with: 48%</div>
                              <div class="progress progress-mini">
                                  <div style="width: 48%;" class="progress-bar"></div>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <div class="small pull-right m-t-xs">9 hours ago</div>
                              <h4>Meeting</h4>
                              By the readable content of a page when looking at its layout.

                              <div class="small">Completion with: 14%</div>
                              <div class="progress progress-mini">
                                  <div style="width: 14%;" class="progress-bar progress-bar-info"></div>
                              </div>
                          </a>
                      </li>
                      <li>
                          <a href="#">
                              <span class="label label-primary pull-right">NEW</span>
                              <h4>The generated</h4>
                              <!--<div class="small pull-right m-t-xs">9 hours ago</div>-->
                              There are many variations of passages of Lorem Ipsum available.
                              <div class="small">Completion with: 22%</div>
                              <div class="small text-muted m-t-xs">Project end: 4:00 pm - 12.06.2014</div>
                          </a>
                      </li>

                  </ul>

              </div>

              <div id="tab-3" class="tab-pane">

                  <div class="sidebar-title">
                      <h3><i class="fa fa-gears"></i> Settings</h3>
                      <small><i class="fa fa-tim"></i> You have 14 projects. 10 not completed.</small>
                  </div>

                  <div class="setings-item">
              <span>
                  Show notifications
              </span>
                      <div class="switch">
                          <div class="onoffswitch">
                              <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example">
                              <label class="onoffswitch-label" for="example">
                                  <span class="onoffswitch-inner"></span>
                                  <span class="onoffswitch-switch"></span>
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="setings-item">
              <span>
                  Disable Chat
              </span>
                      <div class="switch">
                          <div class="onoffswitch">
                              <input type="checkbox" name="collapsemenu" checked class="onoffswitch-checkbox" id="example2">
                              <label class="onoffswitch-label" for="example2">
                                  <span class="onoffswitch-inner"></span>
                                  <span class="onoffswitch-switch"></span>
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="setings-item">
              <span>
                  Enable history
              </span>
                      <div class="switch">
                          <div class="onoffswitch">
                              <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example3">
                              <label class="onoffswitch-label" for="example3">
                                  <span class="onoffswitch-inner"></span>
                                  <span class="onoffswitch-switch"></span>
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="setings-item">
              <span>
                  Show charts
              </span>
                      <div class="switch">
                          <div class="onoffswitch">
                              <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example4">
                              <label class="onoffswitch-label" for="example4">
                                  <span class="onoffswitch-inner"></span>
                                  <span class="onoffswitch-switch"></span>
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="setings-item">
              <span>
                  Offline users
              </span>
                      <div class="switch">
                          <div class="onoffswitch">
                              <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example5">
                              <label class="onoffswitch-label" for="example5">
                                  <span class="onoffswitch-inner"></span>
                                  <span class="onoffswitch-switch"></span>
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="setings-item">
              <span>
                  Global search
              </span>
                      <div class="switch">
                          <div class="onoffswitch">
                              <input type="checkbox" checked name="collapsemenu" class="onoffswitch-checkbox" id="example6">
                              <label class="onoffswitch-label" for="example6">
                                  <span class="onoffswitch-inner"></span>
                                  <span class="onoffswitch-switch"></span>
                              </label>
                          </div>
                      </div>
                  </div>
                  <div class="setings-item">
              <span>
                  Update everyday
              </span>
                      <div class="switch">
                          <div class="onoffswitch">
                              <input type="checkbox" name="collapsemenu" class="onoffswitch-checkbox" id="example7">
                              <label class="onoffswitch-label" for="example7">
                                  <span class="onoffswitch-inner"></span>
                                  <span class="onoffswitch-switch"></span>
                              </label>
                          </div>
                      </div>
                  </div>

                  <div class="sidebar-content">
                      <h4>Settings</h4>
                      <div class="small">
                          I belive that. Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                          And typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s.
                          Over the years, sometimes by accident, sometimes on purpose (injected humour and the like).
                      </div>
                  </div>

              </div>
          </div>

      </div>



  </div>
</div>

<!-- Mainly scripts -->
<script src="js/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="js/plugins/slimscroll/jquery.slimscroll.min.js"></script>

<!-- Flot -->
<script src="js/plugins/flot/jquery.flot.js"></script>
<script src="js/plugins/flot/jquery.flot.tooltip.min.js"></script>
<script src="js/plugins/flot/jquery.flot.spline.js"></script>
<script src="js/plugins/flot/jquery.flot.resize.js"></script>
<script src="js/plugins/flot/jquery.flot.pie.js"></script>
<script src="js/plugins/flot/jquery.flot.symbol.js"></script>
<script src="js/plugins/flot/jquery.flot.time.js"></script>

<!-- Peity -->
<script src="js/plugins/peity/jquery.peity.min.js"></script>
<script src="js/demo/peity-demo.js"></script>

<!-- Custom and plugin javascript -->
<script src="js/inspinia.js"></script>
<script src="js/plugins/pace/pace.min.js"></script>

<!-- jQuery UI -->
<script src="js/plugins/jquery-ui/jquery-ui.min.js"></script>

<!-- Jvectormap -->
<script src="js/plugins/jvectormap/jquery-jvectormap-2.0.2.min.js"></script>
<script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>

<!-- EayPIE -->
<script src="js/plugins/easypiechart/jquery.easypiechart.js"></script>

<!-- Sparkline -->
<script src="js/plugins/sparkline/jquery.sparkline.min.js"></script>

<!-- Sparkline demo data  -->
<script src="js/demo/sparkline-demo.js"></script>

<script>
  $(document).ready(function() {
      $('.chart').easyPieChart({
          barColor: '#f8ac59',
//                scaleColor: false,
          scaleLength: 5,
          lineWidth: 4,
          size: 80
      });

      $('.chart2').easyPieChart({
          barColor: '#1c84c6',
//                scaleColor: false,
          scaleLength: 5,
          lineWidth: 4,
          size: 80
      });

      var data2 = [
          [gd(2012, 1, 1), 7], [gd(2012, 1, 2), 6], [gd(2012, 1, 3), 4], [gd(2012, 1, 4), 8],
          [gd(2012, 1, 5), 9], [gd(2012, 1, 6), 7], [gd(2012, 1, 7), 5], [gd(2012, 1, 8), 4],
          [gd(2012, 1, 9), 7], [gd(2012, 1, 10), 8], [gd(2012, 1, 11), 9], [gd(2012, 1, 12), 6],
          [gd(2012, 1, 13), 4], [gd(2012, 1, 14), 5], [gd(2012, 1, 15), 11], [gd(2012, 1, 16), 8],
          [gd(2012, 1, 17), 8], [gd(2012, 1, 18), 11], [gd(2012, 1, 19), 11], [gd(2012, 1, 20), 6],
          [gd(2012, 1, 21), 6], [gd(2012, 1, 22), 8], [gd(2012, 1, 23), 11], [gd(2012, 1, 24), 13],
          [gd(2012, 1, 25), 7], [gd(2012, 1, 26), 9], [gd(2012, 1, 27), 9], [gd(2012, 1, 28), 8],
          [gd(2012, 1, 29), 5], [gd(2012, 1, 30), 8], [gd(2012, 1, 31), 25]
      ];

      var data3 = [
          [gd(2012, 1, 1), 800], [gd(2012, 1, 2), 500], [gd(2012, 1, 3), 600], [gd(2012, 1, 4), 700],
          [gd(2012, 1, 5), 500], [gd(2012, 1, 6), 456], [gd(2012, 1, 7), 800], [gd(2012, 1, 8), 589],
          [gd(2012, 1, 9), 467], [gd(2012, 1, 10), 876], [gd(2012, 1, 11), 689], [gd(2012, 1, 12), 700],
          [gd(2012, 1, 13), 500], [gd(2012, 1, 14), 600], [gd(2012, 1, 15), 700], [gd(2012, 1, 16), 786],
          [gd(2012, 1, 17), 345], [gd(2012, 1, 18), 888], [gd(2012, 1, 19), 888], [gd(2012, 1, 20), 888],
          [gd(2012, 1, 21), 987], [gd(2012, 1, 22), 444], [gd(2012, 1, 23), 999], [gd(2012, 1, 24), 567],
          [gd(2012, 1, 25), 786], [gd(2012, 1, 26), 666], [gd(2012, 1, 27), 888], [gd(2012, 1, 28), 900],
          [gd(2012, 1, 29), 178], [gd(2012, 1, 30), 555], [gd(2012, 1, 31), 993]
      ];


      var dataset = [
          {
              label: "Number of orders",
              data: data3,
              color: "#1ab394",
              bars: {
                  show: true,
                  align: "center",
                  barWidth: 24 * 60 * 60 * 600,
                  lineWidth:0
              }

          }, {
              label: "Payments",
              data: data2,
              yaxis: 2,
              color: "#1C84C6",
              lines: {
                  lineWidth:1,
                      show: true,
                      fill: true,
                  fillColor: {
                      colors: [{
                          opacity: 0.2
                      }, {
                          opacity: 0.4
                      }]
                  }
              },
              splines: {
                  show: false,
                  tension: 0.6,
                  lineWidth: 1,
                  fill: 0.1
              },
          }
      ];


      var options = {
          xaxis: {
              mode: "time",
              tickSize: [3, "day"],
              tickLength: 0,
              axisLabel: "Date",
              axisLabelUseCanvas: true,
              axisLabelFontSizePixels: 12,
              axisLabelFontFamily: 'Arial',
              axisLabelPadding: 10,
              color: "#d5d5d5"
          },
          yaxes: [{
              position: "left",
              max: 1070,
              color: "#d5d5d5",
              axisLabelUseCanvas: true,
              axisLabelFontSizePixels: 12,
              axisLabelFontFamily: 'Arial',
              axisLabelPadding: 3
          }, {
              position: "right",
              clolor: "#d5d5d5",
              axisLabelUseCanvas: true,
              axisLabelFontSizePixels: 12,
              axisLabelFontFamily: ' Arial',
              axisLabelPadding: 67
          }
          ],
          legend: {
              noColumns: 1,
              labelBoxBorderColor: "#000000",
              position: "nw"
          },
          grid: {
              hoverable: false,
              borderWidth: 0
          }
      };

      function gd(year, month, day) {
          return new Date(year, month - 1, day).getTime();
      }

      var previousPoint = null, previousLabel = null;

      $.plot($("#flot-dashboard-chart"), dataset, options);

      var mapData = {
          "US": 298,
          "SA": 200,
          "DE": 220,
          "FR": 540,
          "CN": 120,
          "AU": 760,
          "BR": 550,
          "IN": 200,
          "GB": 120,
      };

      $('#world-map').vectorMap({
          map: 'world_mill_en',
          backgroundColor: "transparent",
          regionStyle: {
              initial: {
                  fill: '#e4e4e4',
                  "fill-opacity": 0.9,
                  stroke: 'none',
                  "stroke-width": 0,
                  "stroke-opacity": 0
              }
          },

          series: {
              regions: [{
                  values: mapData,
                  scale: ["#1ab394", "#22d6b1"],
                  normalizeFunction: 'polynomial'
              }]
          },
      });
  });
</script>
</body>
</html>



