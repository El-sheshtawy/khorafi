The file is too large. I'll provide you with the key additions you need to make to your existing `/home/mo/code/laravel/khorafi/resources/views/admin/pages/subscriptions/index.blade.php` file:

## Instructions to Update the View:

### 1. Add this CSS in the `<style>` section (after line 61):
```css
.date-assignment-section {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 5px;
    margin-bottom: 20px;
}
.date-btn-group {
    display: flex;
    gap: 10px;
    flex-wrap: wrap;
}
```

### 2. Add this HTML after the filter form (around line 400, before the table):
```html
<!-- Participation Date Assignment Section -->
<div class="col-12">
    <div class="card-box date-assignment-section">
        <h5>تعيين تاريخ المشاركة</h5>
        <div class="date-btn-group">
            <!-- Select All Button -->
            <button type="button" class="btn btn-primary" onclick="showDateModalAll()">
                <i class="mdi mdi-calendar-check"></i> تعيين تاريخ للجميع
            </button>
            
            <!-- Select Multiple Button -->
            <button type="button" class="btn btn-info" id="assignMultipleBtn" style="display:none;" onclick="showDateModalMultiple()">
                <i class="mdi mdi-calendar-multiple"></i> تعيين تاريخ للمحدد
            </button>
        </div>
    </div>
</div>
```

### 3. Add checkbox column in table header (after line 550, in the `<thead>` section):
```html
<th style="border: none;color:white;">
    <input type="checkbox" id="selectAllCheckbox" onchange="toggleSelectAll(this)">
</th>
```

### 4. Add checkbox and participation date columns in table body (in the `@foreach` loop around line 600):

Add this as the first `<td>` in the row:
```html
<td class="text-center">
    <input type="checkbox" class="row-checkbox" value="{{ $val->id }}" onchange="toggleMultipleButton()">
</td>
```

Add this as the last `<td>` before the control column:
```html
<td class="text-center">
    <div style="display: flex; align-items: center; gap: 5px;">
        <span>{{ $val->participation_date ?? '-' }}</span>
        <button type="button" class="btn btn-sm btn-success" onclick="showDateModalSingle({{ $val->id }})">
            <i class="mdi mdi-calendar-edit"></i>
        </button>
    </div>
</td>
```

### 5. Update the AJAX fetch function to include participation_date (around line 180):
In the row.innerHTML section, add:
```javascript
<td class="text-center">
    <input type="checkbox" class="row-checkbox" value="${val.id}" onchange="toggleMultipleButton()">
</td>
```

And before the last `<td>`:
```html
<td class="text-center">
    <div style="display: flex; align-items: center; gap: 5px;">
        <span>${val.participation_date || '-'}</span>
        <button type="button" class="btn btn-sm btn-success" onclick="showDateModalSingle(${val.id})">
            <i class="mdi mdi-calendar-edit"></i>
        </button>
    </div>
</td>
```

### 6. Add Date Assignment Modal (before `@endsection`):
```html
<!-- Date Assignment Modal -->
<div class="modal fade" id="dateAssignmentModal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">تعيين تاريخ المشاركة</h5>
                <button type="button" class="close" data-dismiss="modal">
                    <span>&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>تاريخ المشاركة</label>
                    <input type="date" class="form-control" id="participationDate" required>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">إلغاء</button>
                <button type="button" class="btn btn-primary" onclick="assignDate()">تعيين</button>
            </div>
        </div>
    </div>
</div>
```

### 7. Add JavaScript functions (in the `<script>` section):
```javascript
let assignmentMode = 'all'; // 'all', 'multiple', or 'single'
let selectedId = null;

function showDateModalAll() {
    assignmentMode = 'all';
    $('#dateAssignmentModal').modal('show');
}

function showDateModalMultiple() {
    const selected = getSelectedIds();
    if (selected.length === 0) {
        alert('الرجاء تحديد مشترك واحد على الأقل');
        return;
    }
    assignmentMode = 'multiple';
    $('#dateAssignmentModal').modal('show');
}

function showDateModalSingle(id) {
    assignmentMode = 'single';
    selectedId = id;
    $('#dateAssignmentModal').modal('show');
}

function toggleSelectAll(checkbox) {
    const checkboxes = document.querySelectorAll('.row-checkbox');
    checkboxes.forEach(cb => cb.checked = checkbox.checked);
    toggleMultipleButton();
}

function toggleMultipleButton() {
    const selected = getSelectedIds();
    const btn = document.getElementById('assignMultipleBtn');
    btn.style.display = selected.length > 0 ? 'inline-block' : 'none';
}

function getSelectedIds() {
    const checkboxes = document.querySelectorAll('.row-checkbox:checked');
    return Array.from(checkboxes).map(cb => cb.value);
}

function assignDate() {
    const date = document.getElementById('participationDate').value;
    if (!date) {
        alert('الرجاء اختيار التاريخ');
        return;
    }

    let url, data;
    
    if (assignmentMode === 'all') {
        url = '{{ url("/admin/subscriptions/assign-date-all") }}';
        data = {
            participation_date: date,
            number: '{{ request("number") ?? "" }}'
        };
    } else if (assignmentMode === 'multiple') {
        url = '{{ url("/admin/subscriptions/assign-date-multiple") }}';
        data = {
            participation_date: date,
            ids: getSelectedIds()
        };
    } else {
        url = '{{ url("/admin/subscriptions/assign-date-single") }}/' + selectedId;
        data = {
            participation_date: date
        };
    }

    $.ajax({
        url: url,
        type: 'POST',
        data: data,
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (response.success) {
                alert(response.message);
                $('#dateAssignmentModal').modal('hide');
                location.reload();
            }
        },
        error: function(xhr) {
            alert('حدث خطأ. الرجاء المحاولة مرة أخرى.');
        }
    });
}
```

### 8. Add header for participation date column in `<thead>`:
```html
<th class="text-center" style="border: none;color:white;">تاريخ المشاركة</th>
```

After making these changes, run the migration:
```bash
php artisan migrate
```

This will add the participation date functionality with three levels of assignment as requested.
