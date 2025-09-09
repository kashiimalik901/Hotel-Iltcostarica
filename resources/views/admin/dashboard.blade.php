@extends('admin.layouts.app')

@section('content')
<div class="row g-3 mb-3">
  <div class="col-md-6 col-xxl-3">
    <div class="card h-md-100 ecommerce-card-min-width">
      <div class="card-header pb-0">
        <h6 class="mb-0 mt-2 d-flex align-items-center">Weekly Sales<span class="ms-1 text-400" data-bs-toggle="tooltip" data-bs-placement="top" title="Calculated according to last week's sales"><span class="far fa-question-circle" data-fa-transform="shrink-1"></span></span></h6>
      </div>
      <div class="card-body d-flex flex-column justify-content-end">
        <div class="row">
          <div class="col">
            <p class="font-sans-serif lh-1 mb-1 fs-5">${{ number_format($stats['weekly_revenue'] ?? 47, 0) }}K</p><span class="badge badge-subtle-success rounded-pill fs-11">+3.5%</span>
          </div>
          <div class="col-auto ps-0">
            <div class="echart-bar-weekly-sales h-100"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xxl-3">
    <div class="card h-md-100">
      <div class="card-header pb-0">
        <h6 class="mb-0 mt-2">Total Orders</h6>
      </div>
      <div class="card-body d-flex flex-column justify-content-end">
        <div class="row justify-content-between">
          <div class="col-auto align-self-end">
            <div class="fs-5 fw-normal font-sans-serif text-700 lh-1 mb-1">{{ number_format($stats['total_bookings'] ?? 58.4, 1) }}K</div><span class="badge rounded-pill fs-11 bg-200 text-primary"><span class="fas fa-caret-up me-1"></span>13.6%</span>
          </div>
          <div class="col-auto ps-0 mt-n4">
            <div class="echart-default-total-order" data-echarts='{"tooltip":{"trigger":"axis","formatter":"{b0} : {c0}"},"xAxis":{"data":["Week 4","Week 5","Week 6","Week 7"]},"series":[{"type":"line","data":[20,40,100,120],"smooth":true,"lineStyle":{"width":3}}],"grid":{"bottom":"2%","top":"2%","right":"0","left":"10px"}}' data-echart-responsive="true"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xxl-3">
    <div class="card h-md-100">
      <div class="card-body">
        <div class="row h-100 justify-content-between g-0">
          <div class="col-5 col-sm-6 col-xxl pe-2">
            <h6 class="mt-1">Market Share</h6>
            <div class="fs-11 mt-3">
              <div class="d-flex flex-between-center mb-1">
                <div class="d-flex align-items-center"><span class="dot bg-primary"></span><span class="fw-semi-bold">Samsung</span></div>
                <div class="d-xxl-none">33%</div>
              </div>
              <div class="d-flex flex-between-center mb-1">
                <div class="d-flex align-items-center"><span class="dot bg-info"></span><span class="fw-semi-bold">Huawei</span></div>
                <div class="d-xxl-none">29%</div>
              </div>
              <div class="d-flex flex-between-center mb-1">
                <div class="d-flex align-items-center"><span class="dot bg-300"></span><span class="fw-semi-bold">Apple</span></div>
                <div class="d-xxl-none">20%</div>
              </div>
            </div>
          </div>
          <div class="col-auto position-relative">
            <div class="echart-market-share"></div>
            <div class="position-absolute top-50 start-50 translate-middle text-1100 fs-7">26M</div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-md-6 col-xxl-3">
    <div class="card h-md-100">
      <div class="card-header d-flex flex-between-center pb-0">
        <h6 class="mb-0">Weather</h6>
        <div class="dropdown font-sans-serif btn-reveal-trigger">
          <button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button" id="dropdown-weather-update" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs-11"></span></button>
          <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-weather-update"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
            <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
          </div>
        </div>
      </div>
      <div class="card-body pt-2">
        <div class="row g-0 h-100 align-items-center">
          <div class="col">
            <div class="d-flex align-items-center"><img class="me-3" src="{{ asset('falcon/assets/img/icons/weather-icon.png') }}" alt="" height="60" />
              <div>
                <h6 class="mb-2">New York City</h6>
                <div class="fs-11 fw-semi-bold">
                  <div class="text-warning">Sunny</div>Precipitation: 50%
                </div>
              </div>
            </div>
          </div>
          <div class="col-auto text-center ps-2">
            <div class="fs-5 fw-normal font-sans-serif text-primary mb-1 lh-1">31°</div>
            <div class="fs-10 text-800">32° / 25°</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="row g-0">
  <div class="col-lg-6 pe-lg-2 mb-3">
    <div class="card h-lg-100 overflow-hidden">
      <div class="card-header bg-body-tertiary">
        <div class="row align-items-center">
          <div class="col">
            <h6 class="mb-0">Running Projects</h6>
          </div>
          <div class="col-auto text-center pe-x1">
            <select class="form-select form-select-sm">
              <option>Working Time</option>
              <option>Estimated Time</option>
              <option>Billable Time</option>
            </select>
          </div>
        </div>
      </div>
      <div class="card-body p-0">
        <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
          <div class="col ps-x1 py-1 position-static">
            <div class="d-flex align-items-center">
              <div class="avatar avatar-xl me-3">
                <div class="avatar-name rounded-circle bg-primary-subtle text-dark"><span class="fs-9 text-primary">F</span></div>
              </div>
              <div class="flex-1">
                <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link" href="#!">Falcon</a><span class="badge rounded-pill ms-2 bg-200 text-primary">38%</span></h6>
              </div>
            </div>
          </div>
          <div class="col py-1">
            <div class="row flex-end-center g-0">
              <div class="col-auto pe-2">
                <div class="fs-10 fw-semi-bold">12:50:00</div>
              </div>
              <div class="col-5 pe-x1 ps-2">
                <div class="progress bg-200 me-2" style="height: 5px;" role="progressbar" aria-valuenow="38" aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar rounded-pill" style="width: 38%;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
          <div class="col ps-x1 py-1 position-static">
            <div class="d-flex align-items-center">
              <div class="avatar avatar-xl me-3">
                <div class="avatar-name rounded-circle bg-success-subtle text-dark"><span class="fs-9 text-success">R</span></div>
              </div>
              <div class="flex-1">
                <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link" href="#!">Reign</a><span class="badge rounded-pill ms-2 bg-200 text-primary">79%</span></h6>
              </div>
            </div>
          </div>
          <div class="col py-1">
            <div class="row flex-end-center g-0">
              <div class="col-auto pe-2">
                <div class="fs-10 fw-semi-bold">25:20:00</div>
              </div>
              <div class="col-5 pe-x1 ps-2">
                <div class="progress bg-200 me-2" style="height: 5px;" role="progressbar" aria-valuenow="79" aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar rounded-pill" style="width: 79%;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
          <div class="col ps-x1 py-1 position-static">
            <div class="d-flex align-items-center">
              <div class="avatar avatar-xl me-3">
                <div class="avatar-name rounded-circle bg-info-subtle text-dark"><span class="fs-9 text-info">B</span></div>
              </div>
              <div class="flex-1">
                <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link" href="#!">Boots4</a><span class="badge rounded-pill ms-2 bg-200 text-primary">90%</span></h6>
              </div>
            </div>
          </div>
          <div class="col py-1">
            <div class="row flex-end-center g-0">
              <div class="col-auto pe-2">
                <div class="fs-10 fw-semi-bold">58:20:00</div>
              </div>
              <div class="col-5 pe-x1 ps-2">
                <div class="progress bg-200 me-2" style="height: 5px;" role="progressbar" aria-valuenow="90" aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar rounded-pill" style="width: 90%;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row g-0 align-items-center py-2 position-relative border-bottom border-200">
          <div class="col ps-x1 py-1 position-static">
            <div class="d-flex align-items-center">
              <div class="avatar avatar-xl me-3">
                <div class="avatar-name rounded-circle bg-warning-subtle text-dark"><span class="fs-9 text-warning">R</span></div>
              </div>
              <div class="flex-1">
                <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link" href="#!">Raven</a><span class="badge rounded-pill ms-2 bg-200 text-primary">40%</span></h6>
              </div>
            </div>
          </div>
          <div class="col py-1">
            <div class="row flex-end-center g-0">
              <div class="col-auto pe-2">
                <div class="fs-10 fw-semi-bold">21:20:00</div>
              </div>
              <div class="col-5 pe-x1 ps-2">
                <div class="progress bg-200 me-2" style="height: 5px;" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar rounded-pill" style="width: 40%;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row g-0 align-items-center py-2 position-relative">
          <div class="col ps-x1 py-1 position-static">
            <div class="d-flex align-items-center">
              <div class="avatar avatar-xl me-3">
                <div class="avatar-name rounded-circle bg-danger-subtle text-dark"><span class="fs-9 text-danger">S</span></div>
              </div>
              <div class="flex-1">
                <h6 class="mb-0 d-flex align-items-center"><a class="text-800 stretched-link" href="#!">Slick</a><span class="badge rounded-pill ms-2 bg-200 text-primary">70%</span></h6>
              </div>
            </div>
          </div>
          <div class="col py-1">
            <div class="row flex-end-center g-0">
              <div class="col-auto pe-2">
                <div class="fs-10 fw-semi-bold">31:20:00</div>
              </div>
              <div class="col-5 pe-x1 ps-2">
                <div class="progress bg-200 me-2" style="height: 5px;" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100">
                  <div class="progress-bar rounded-pill" style="width: 70%;"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer bg-body-tertiary p-0"><a class="btn btn-sm btn-link d-block w-100 py-2" href="#!">Show all projects<span class="fas fa-chevron-right ms-1 fs-11"></span></a></div>
    </div>
  </div>
  <div class="col-lg-6 ps-lg-2 mb-3">
    <div class="card h-lg-100">
      <div class="card-header">
        <div class="row flex-between-center">
          <div class="col-auto">
            <h6 class="mb-0">Total Sales</h6>
          </div>
          <div class="col-auto d-flex">
            <select class="form-select form-select-sm select-month me-2">
              <option value="0">January</option>
              <option value="1">February</option>
              <option value="2">March</option>
              <option value="3">April</option>
              <option value="4">May</option>
              <option value="5">Jun</option>
              <option value="6">July</option>
              <option value="7">August</option>
              <option value="8">September</option>
              <option value="9">October</option>
              <option value="10">November</option>
              <option value="11">December</option>
            </select>
            <div class="dropdown font-sans-serif btn-reveal-trigger">
              <button class="btn btn-link text-600 btn-sm dropdown-toggle dropdown-caret-none btn-reveal" type="button" id="dropdown-total-sales" data-bs-toggle="dropdown" data-boundary="viewport" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-h fs-11"></span></button>
              <div class="dropdown-menu dropdown-menu-end border py-2" aria-labelledby="dropdown-total-sales"><a class="dropdown-item" href="#!">View</a><a class="dropdown-item" href="#!">Export</a>
                <div class="dropdown-divider"></div><a class="dropdown-item text-danger" href="#!">Remove</a>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="card-body h-100 pe-0">
        <!-- Find the JS file for the following chart at: src\js\charts\echarts\total-sales.js-->
        <!-- If you are not using gulp based workflow, you can find the transpiled code at: public\assets\js\theme.js-->
        <div class="echart-line-total-sales h-100" data-echart-responsive="true"></div>
      </div>
    </div>
  </div>
</div>
<div class="row g-0">
  <div class="col-lg-6 col-xl-7 col-xxl-8 mb-3 pe-lg-2 mb-3">
    <div class="card h-lg-100">
      <div class="card-body d-flex align-items-center">
        <div class="w-100">
          <h6 class="mb-3 text-800">Using Storage <strong class="text-1100">1775.06 MB </strong>of 2 GB</h6>
          <div class="progress-stacked mb-3 rounded-3" style="height: 10px;">
            <div class="progress" style="width: 43.72%;" role="progressbar" aria-valuenow="43.72" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-progress-gradient border-end border-100 border-2"></div>
            </div>
            <div class="progress" style="width: 18.76%;" role="progressbar" aria-valuenow="18.76" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-info border-end border-100 border-2"></div>
            </div>
            <div class="progress" style="width: 9.38%;" role="progressbar" aria-valuenow="9.38" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-success border-end border-100 border-2"></div>
            </div>
            <div class="progress" style="width: 28.14%;" role="progressbar" aria-valuenow="28.14" aria-valuemin="0" aria-valuemax="100">
              <div class="progress-bar bg-200"></div>
            </div>
          </div>
          <div class="row fs-10 fw-semi-bold text-500 g-0">
            <div class="col-auto d-flex align-items-center pe-3"><span class="dot bg-primary"></span><span>Regular</span><span class="d-none d-md-inline-block d-lg-none d-xxl-inline-block">(895MB)</span></div>
            <div class="col-auto d-flex align-items-center pe-3"><span class="dot bg-info"></span><span>System</span><span class="d-none d-md-inline-block d-lg-none d-xxl-inline-block">(379MB)</span></div>
            <div class="col-auto d-flex align-items-center pe-3"><span class="dot bg-success"></span><span>Shared</span><span class="d-none d-md-inline-block d-lg-none d-xxl-inline-block">(192MB)</span></div>
            <div class="col-auto d-flex align-items-center"><span class="dot bg-200"></span><span>Free</span><span class="d-none d-md-inline-block d-lg-none d-xxl-inline-block">(576MB)</span></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-6 col-xl-5 col-xxl-4 mb-3 ps-lg-2">
    <div class="card h-lg-100">
      <div class="bg-holder bg-card" style="background-image:url({{ asset('falcon/assets/img/icons/spot-illustrations/corner-1.png') }});">
      </div>
      <!--/.bg-holder-->

      <div class="card-body position-relative">
        <h5 class="text-warning">Running out of your space?</h5>
        <p class="fs-10 mb-0">Your storage will be running out soon. Get more space and powerful productivity features.</p><a class="btn btn-link fs-10 text-warning mt-lg-3 ps-0" href="#!">Upgrade storage<span class="fas fa-chevron-right ms-1" data-fa-transform="shrink-4 down-1"></span></a>
      </div>
    </div>
  </div>
</div>
<div class="row g-0">
  <div class="col-lg-7 col-xl-8 pe-lg-2 mb-3">
    <div class="card h-lg-100 overflow-hidden">
      <div class="card-body p-0">
        <div class="table-responsive scrollbar">
          <table class="table table-dashboard mb-0 table-borderless fs-10 border-200">
            <thead class="bg-body-tertiary">
              <tr>
                <th class="text-900">Best Selling Products</th>
                <th class="text-900 text-end">Revenue ($3333)</th>
                <th class="text-900 pe-x1 text-end" style="width: 8rem">Revenue (%)</th>
              </tr>
            </thead>
            <tbody>
              <tr class="border-bottom border-200">
                <td>
                  <div class="d-flex align-items-center position-relative"><img class="rounded-1 border border-200" src="{{ asset('falcon/assets/img/products/12.png') }}" width="60" alt="" />
                    <div class="flex-1 ms-3">
                      <h6 class="mb-1 fw-semi-bold"><a class="text-1100 stretched-link" href="#!">Raven Pro</a></h6>
                      <p class="fw-semi-bold mb-0 text-500">Landing</p>
                    </div>
                  </div>
                </td>
                <td class="align-middle text-end fw-semi-bold">$1311</td>
                <td class="align-middle pe-x1">
                  <div class="d-flex align-items-center">
                    <div class="progress me-3 rounded-3 bg-200" style="height: 5px; width:80px;" role="progressbar" aria-valuenow="39" aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar rounded-pill" style="width: 39%;"></div>
                    </div>
                    <div class="fw-semi-bold ms-2">39%</div>
                  </div>
                </td>
              </tr>
              <tr class="border-bottom border-200">
                <td>
                  <div class="d-flex align-items-center position-relative"><img class="rounded-1 border border-200" src="{{ asset('falcon/assets/img/products/10.png') }}" width="60" alt="" />
                    <div class="flex-1 ms-3">
                      <h6 class="mb-1 fw-semi-bold"><a class="text-1100 stretched-link" href="#!">Boots4</a></h6>
                      <p class="fw-semi-bold mb-0 text-500">Portfolio</p>
                    </div>
                  </div>
                </td>
                <td class="align-middle text-end fw-semi-bold">$860</td>
                <td class="align-middle pe-x1">
                  <div class="d-flex align-items-center">
                    <div class="progress me-3 rounded-3 bg-200" style="height: 5px; width:80px;" role="progressbar" aria-valuenow="26" aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar rounded-pill" style="width: 26%;"></div>
                    </div>
                    <div class="fw-semi-bold ms-2">26%</div>
                  </div>
                </td>
              </tr>
              <tr class="border-bottom border-200">
                <td>
                  <div class="d-flex align-items-center position-relative"><img class="rounded-1 border border-200" src="{{ asset('falcon/assets/img/products/11.png') }}" width="60" alt="" />
                    <div class="flex-1 ms-3">
                      <h6 class="mb-1 fw-semi-bold"><a class="text-1100 stretched-link" href="#!">Falcon</a></h6>
                      <p class="fw-semi-bold mb-0 text-500">Admin</p>
                    </div>
                  </div>
                </td>
                <td class="align-middle text-end fw-semi-bold">$539</td>
                <td class="align-middle pe-x1">
                  <div class="d-flex align-items-center">
                    <div class="progress me-3 rounded-3 bg-200" style="height: 5px; width:80px;" role="progressbar" aria-valuenow="16" aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar rounded-pill" style="width: 16%;"></div>
                    </div>
                    <div class="fw-semi-bold ms-2">16%</div>
                  </div>
                </td>
              </tr>
              <tr class="border-bottom border-200">
                <td>
                  <div class="d-flex align-items-center position-relative"><img class="rounded-1 border border-200" src="{{ asset('falcon/assets/img/products/14.png') }}" width="60" alt="" />
                    <div class="flex-1 ms-3">
                      <h6 class="mb-1 fw-semi-bold"><a class="text-1100 stretched-link" href="#!">Slick</a></h6>
                      <p class="fw-semi-bold mb-0 text-500">Builder</p>
                    </div>
                  </div>
                </td>
                <td class="align-middle text-end fw-semi-bold">$343</td>
                <td class="align-middle pe-x1">
                  <div class="d-flex align-items-center">
                    <div class="progress me-3 rounded-3 bg-200" style="height: 5px; width:80px;" role="progressbar" aria-valuenow="10" aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar rounded-pill" style="width: 10%;"></div>
                    </div>
                    <div class="fw-semi-bold ms-2">10%</div>
                  </div>
                </td>
              </tr>
              <tr>
                <td>
                  <div class="d-flex align-items-center position-relative"><img class="rounded-1 border border-200" src="{{ asset('falcon/assets/img/products/13.png') }}" width="60" alt="" />
                    <div class="flex-1 ms-3">
                      <h6 class="mb-1 fw-semi-bold"><a class="text-1100 stretched-link" href="#!">Reign Pro</a></h6>
                      <p class="fw-semi-bold mb-0 text-500">Agency</p>
                    </div>
                  </div>
                </td>
                <td class="align-middle text-end fw-semi-bold">$280</td>
                <td class="align-middle pe-x1">
                  <div class="d-flex align-items-center">
                    <div class="progress me-3 rounded-3 bg-200" style="height: 5px; width:80px;" role="progressbar" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100">
                      <div class="progress-bar rounded-pill" style="width: 8%;"></div>
                    </div>
                    <div class="fw-semi-bold ms-2">8%</div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="card-footer bg-body-tertiary py-2">
        <div class="row flex-between-center">
          <div class="col-auto">
            <select class="form-select form-select-sm">
              <option>Last 7 days</option>
              <option>Last Month</option>
              <option>Last Year</option>
            </select>
          </div>
          <div class="col-auto">
            <a class="btn btn-sm btn-link" href="#!">View All</a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="col-lg-5 col-xl-4 ps-lg-2 mb-3">
    <div class="card h-lg-100">
      <div class="card-header">
        <h6 class="mb-0">Recent Activity</h6>
      </div>
      <div class="card-body p-0">
        <div class="scrollbar-overlay" style="max-height: 20rem;">
          <div class="list-group list-group-flush fw-normal fs-10">
            <div class="list-group-item">
              <a class="notification notification-flush notification-unread" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-2xl me-3">
                    <img class="rounded-circle" src="{{ asset('falcon/assets/img/team/1-thumb.png') }}" alt="" />
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1"><strong>Emma Watson</strong> replied to your comment : "Hello world 😍"</p>
                  <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">💬</span>Just now</span>
                </div>
              </a>
            </div>
            <div class="list-group-item">
              <a class="notification notification-flush notification-unread" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-2xl me-3">
                    <div class="avatar-name rounded-circle"><span>AB</span></div>
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1"><strong>Albert Brooks</strong> reacted to <strong>Mia Khalifa's</strong> status</p>
                  <span class="notification-time"><span class="me-2 fab fa-gratipay text-danger"></span>9hr</span>
                </div>
              </a>
            </div>
            <div class="list-group-item">
              <a class="notification notification-flush" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-2xl me-3">
                    <img class="rounded-circle" src="{{ asset('falcon/assets/img/icons/weather-sm.jpg') }}" alt="" />
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1">The forecast today shows a low of 20°C in California. See today's weather.</p>
                  <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🌤️</span>1d</span>
                </div>
              </a>
            </div>
            <div class="list-group-item">
              <a class="border-bottom-0 notification-unread  notification notification-flush" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-xl me-3">
                    <img class="rounded-circle" src="{{ asset('falcon/assets/img/logos/oxford.png') }}" alt="" />
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1"><strong>University of Oxford</strong> created an event : "Causal Inference Hilary 2019"</p>
                  <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">✌️</span>1w</span>
                </div>
              </a>
            </div>
            <div class="list-group-item">
              <a class="border-bottom-0 notification notification-flush" href="#!">
                <div class="notification-avatar">
                  <div class="avatar avatar-xl me-3">
                    <img class="rounded-circle" src="{{ asset('falcon/assets/img/team/10.jpg') }}" alt="" />
                  </div>
                </div>
                <div class="notification-body">
                  <p class="mb-1"><strong>James Cameron</strong> invited to join the group: United Nations International Children's Fund</p>
                  <span class="notification-time"><span class="me-2" role="img" aria-label="Emoji">🙋‍</span>2d</span>
                </div>
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="card-footer text-center border-top"><a class="card-link d-block" href="#!">View all</a></div>
    </div>
  </div>
</div>

<style>
.dot {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  display: inline-block;
}

.badge-subtle-success {
  background-color: rgba(0, 210, 122, 0.1);
  color: #00d27a;
}

.bg-200 {
  background-color: #f9fbfd !important;
}

.bg-300 {
  background-color: #e9ecef !important;
}

.bg-primary-subtle {
  background-color: rgba(56, 116, 255, 0.1) !important;
}

.bg-success-subtle {
  background-color: rgba(0, 210, 122, 0.1) !important;
}

.bg-info-subtle {
  background-color: rgba(57, 175, 209, 0.1) !important;
}

.bg-warning-subtle {
  background-color: rgba(245, 128, 62, 0.1) !important;
}

.bg-danger-subtle {
  background-color: rgba(230, 55, 87, 0.1) !important;
}

.bg-progress-gradient {
  background: linear-gradient(90deg, #3874ff 0%, #5c8cff 100%) !important;
}

.text-1100 {
  color: #2c3e50 !important;
}

.text-800 {
  color: #5e6e82 !important;
}

.text-700 {
  color: #6e7891 !important;
}

.text-600 {
  color: #8898aa !important;
}

.text-500 {
  color: #a1a8b8 !important;
}

.text-400 {
  color: #b9c0c9 !important;
}

.fs-7 {
  font-size: 0.875rem !important;
}

.fs-8 {
  font-size: 0.75rem !important;
}

.fs-9 {
  font-size: 0.625rem !important;
}

.fs-10 {
  font-size: 0.5rem !important;
}

.fs-11 {
  font-size: 0.375rem !important;
}

.pe-x1 {
  padding-right: 1.5rem !important;
}

.ps-x1 {
  padding-left: 1.5rem !important;
}

.mt-n4 {
  margin-top: -1.5rem !important;
}

.mt-n3 {
  margin-top: -1rem !important;
}

.border-100 {
  border-color: #f8f9fa !important;
}

.border-200 {
  border-color: #e9ecef !important;
}

.btn-reveal {
  position: relative;
  top: 0;
  right: 0;
  z-index: 2;
}

.btn-reveal:hover {
  color: #000;
}

.scrollbar-overlay {
  overflow-y: auto;
  overflow-x: hidden;
}

.scrollbar-overlay::-webkit-scrollbar {
  width: 6px;
}

.scrollbar-overlay::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

.scrollbar-overlay::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

.scrollbar-overlay::-webkit-scrollbar-thumb:hover {
  background: #a8a8a8;
}
</style>
@endsection
