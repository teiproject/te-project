<form class="trust-card p-4" method="post" action="{{ route('project.requests.store') }}">
    @csrf
    <div class="row g-3">
        <div class="col-md-6"><label class="form-label">Name</label><input name="client_name" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">Email</label><input type="email" name="email" class="form-control" required></div>
        <div class="col-md-6"><label class="form-label">Phone</label><input name="phone" class="form-control"></div>
        <div class="col-md-6"><label class="form-label">Company</label><input name="company" class="form-control"></div>
        <div class="col-md-6"><label class="form-label">Service</label><select name="service" class="form-select"><option>Custom Web Application</option><option>CRM / ERP Solution</option><option>SaaS Product MVP</option><option>Website & Landing System</option></select></div>
        <div class="col-md-6"><label class="form-label">Timeline</label><input type="number" name="timeline_weeks" value="6" min="2" max="52" class="form-control"></div>
        <input type="hidden" name="platform" value="Web"><input type="hidden" name="pages" value="5"><input type="hidden" name="budget_range" value="Discovery required">
        <div class="col-12"><label class="form-label">Message</label><textarea name="message" rows="5" class="form-control" required></textarea></div>
        <div class="col-12"><button class="btn btn-primary rounded-pill px-4">Request Demo</button></div>
    </div>
</form>
