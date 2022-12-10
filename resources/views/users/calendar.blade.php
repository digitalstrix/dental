@extends('users.layouts.master');
@section('title','Events Dashboard');
@section('content');
<main role="main" class="main-content">
    <div class="container-fluid">
      <div class="row justify-content-center">
        <div class="col-12">
          <div class="row align-items-center my-3">
            <div class="col">
              <h2 class="page-title">Calendar</h2>
            </div>
            <div class="col-auto">
              <button type="button" class="btn" data-toggle="modal" data-target=".modal-calendar"><span class="fe fe-filter fe-16 text-muted"></span></button>
              <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#eventModal"><span class="fe fe-plus fe-16 mr-3"></span>New Event</button>
            </div>
          </div>
          <div id='calendar'></div>
          <!-- new event modal -->
          <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="varyModalLabel">New Event</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body p-4">
                  <form>
                    <div class="form-group">
                      <label for="eventTitle" class="col-form-label">Title</label>
                      <input type="text" class="form-control" id="eventTitle" placeholder="Add event title">
                    </div>
                    <div class="form-group">
                      <label for="eventNote" class="col-form-label">Note</label>
                      <textarea class="form-control" id="eventNote" placeholder="Add some note for your event"></textarea>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-8">
                        <label for="eventType">Event type</label>
                        <select id="eventType" class="form-control select2">
                          <option value="work">Work</option>
                          <option value="home">Home</option>
                        </select>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="date-input1">Start Date</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                          </div>
                          <input type="text" class="form-control drgpicker" id="drgpicker-start" value="04/24/2020">
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="startDate">Start Time</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text" id="button-addon-time"><span class="fe fe-clock fe-16"></span></div>
                          </div>
                          <input type="text" class="form-control time-input" id="start-time" placeholder="10:00 AM">
                        </div>
                      </div>
                    </div>
                    <div class="form-row">
                      <div class="form-group col-md-6">
                        <label for="date-input1">End Date</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text" id="button-addon-date"><span class="fe fe-calendar fe-16"></span></div>
                          </div>
                          <input type="text" class="form-control drgpicker" id="drgpicker-end" value="04/24/2020">
                        </div>
                      </div>
                      <div class="form-group col-md-6">
                        <label for="startDate">End Time</label>
                        <div class="input-group">
                          <div class="input-group-prepend">
                            <div class="input-group-text" id="button-addon-time"><span class="fe fe-clock fe-16"></span></div>
                          </div>
                          <input type="text" class="form-control time-input" id="end-time" placeholder="11:00 AM">
                        </div>
                      </div>
                    </div>
                  </form>
                </div>
                <div class="modal-footer d-flex justify-content-between">
                  <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="RepeatSwitch" checked>
                    <label class="custom-control-label" for="RepeatSwitch">All day</label>
                  </div>
                  <button type="button" class="btn mb-2 btn-primary">Save Event</button>
                </div>
              </div>
            </div>
          </div> <!-- new event modal -->
        </div> <!-- .col-12 -->
      </div> <!-- .row -->
    </div> <!-- .container-fluid -->
    
    <!-- main -->
@endsection
@section('scripts')
<script src='{{asset('js/fullcalendar.js')}}'></script>
<script src='{{asset('js/fullcalendar.custom.js')}}'></script>
<script>
    /** full calendar */
    
    var calendarEl = document.getElementById('calendar');
    if (calendarEl)
    {
      document.addEventListener('DOMContentLoaded', function()
      {
        var calendar = new FullCalendar.Calendar(calendarEl,
        {
          plugins: ['dayGrid', 'timeGrid', 'list', 'bootstrap'],
          timeZone: 'UTC',
          themeSystem: 'bootstrap',
          header:
          {
            left: 'today, prev, next',
            center: 'title',
            right: 'dayGridMonth,timeGridWeek,timeGridDay,listMonth'
          },
          buttonIcons:
          {
            prev: 'fe-arrow-left',
            next: 'fe-arrow-right',
            prevYear: 'left-double-arrow',
            nextYear: 'right-double-arrow'
          },
          weekNumbers: true,
          eventLimit: true, // allow "more" link when too many events
          events: 'https://fullcalendar.io/demo-events.json'
        });
        calendar.render();
      });
    }
  </script>
  @endsection