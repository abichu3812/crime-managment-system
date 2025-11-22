@extends('investigation_leader.investigation_leader_dashboard')
@section('investigation_leader')

<style>
    .evidence-table {
        font-size: 0.9rem;
    }
    .evidence-table th {
        background-color: #003f00;
        color: white;
        font-weight: bold;
        position: sticky;
        top: 0;
    }
    .clickable-photo {
        transition: transform 0.3s ease;
    }
    .clickable-photo:hover {
        transform: scale(1.1);
        cursor: zoom-in;
    }
    .evidence-badge {
        font-size: 0.8rem;
        padding: 0.35em 0.65em;
    }
    .status-badge {
        font-size: 0.75rem;
        padding: 0.4em 0.6em;
    }
    .action-btn {
        padding: 0.25rem 0.5rem;
        font-size: 0.8rem;
    }
    .table-responsive {
        max-height: 75vh;
        overflow-y: auto;
    }
</style>

<div class="page-content" style="padding: 20px;">

    <!-- Photo/Evidence Modal -->
    <div class="modal fade" id="evidenceModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl">
            <div class="modal-content">
                <div class="modal-header bg-dark text-white">
                    <h5 class="modal-title" id="evidenceModalLabel">Evidence Preview</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center p-0">
                    <div id="mediaContainer">
                        <!-- Content will be dynamically inserted here -->
                    </div>
                </div>
                <div class="modal-footer bg-dark">
                    <a id="downloadBtn" href="#" class="btn btn-success me-2" download>
                        <i class="fas fa-download me-1"></i> Download
                    </a>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        <i class="fas fa-times me-1"></i> Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- Reports Table Section -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title text-warning mb-0">
                            <i class="fas fa-file-alt me-2"></i> Investigation Reports
                        </h4>
                        <div class="dropdown">
                            <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="filterDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-filter me-1"></i> Filter
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="filterDropdown">
                                <li><a class="dropdown-item" href="#" data-status="all">All Reports</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="#" data-status="pending">Pending Review</a></li>
                                <li><a class="dropdown-item" href="#" data-status="under_review">Under Review</a></li>
                                <li><a class="dropdown-item" href="#" data-status="approved">Approved</a></li>
                                <li><a class="dropdown-item" href="#" data-status="rejected">Rejected</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="investigationReportsTable" class="table table-hover table-bordered evidence-table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Full Name</th>
                                    <th>Age</th>
                                    <th>Gender</th>
                                    <th>Personal Photo</th>
                                    <th>Interview(text)</th>
                                    <th>Video Evidence</th>
                                    <th>Audio Evidence</th>
                                    <th>Additional Note</th>
                                    <th>DNA Evidence</th>
                                    <th>Forensic Evidence</th>
                                    <th>Submitted On</th>
                                    
                                   
                                    
                                
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($types as $type)
                                <tr data-status="{{ $type->status }}">
                                    <td>{{ $type->id }}</td>
                                    <td>{{ $type->full_name ?? 'N/A' }}</td>
                                    <td>{{ $type->age ?? 'N/A' }}</td>
                                    <td>{{ ucfirst($type->gender) ?? 'N/A' }}</td>
                                               <td>
                                        @if($type->personal_photo)
                                        <span class="badge bg-primary evidence-badge" 
                                                data-type="photo" 
                                                data-src="{{ asset('upload/investigation_reports/' . $type->personal_photo) }}"
                                                title="Personal Photo">
                                            <i class="fas fa-camera me-1"></i> Photo
                                        </span>
                                        @endif
                                    </td>
                                    <td>{{ $type->interview ?? 'N/A' }}</td>
                                                   <td>
                                        @if($type->video_evidence)
                                        <span class="badge bg-danger evidence-badge" 
                                                data-type="video" 
                                                data-src="{{ asset('upload/investigation_reports/' . $type->video_evidence) }}"
                                                title="Video Evidence">
                                            <i class="fas fa-video me-1"></i> Video
                                        </span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($type->audio_evidence)
                                        <span class="badge bg-info evidence-badge" 
                                                data-type="audio" 
                                                data-src="{{ asset('upload/investigation_reports/' . $type->audio_evidence) }}"
                                                title="Audio Evidence">
                                            <i class="fas fa-microphone me-1"></i> Audio
                                        </span>
                                        @endif
                                    </td>
                                    
                                    <td>{{ $type->additional_notes ?? 'N/A' }}</td>
                                    <td>{{ $type->dna_evidence ?? 'N/A' }}</td>
                                    <td>{{ $type->forensic_evidence ?? 'N/A' }}</td>
                           
                                    <td>{{ $type->created_at->format('M d, Y H:i') }}</td>
                     
                         
                          
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap modal
    const evidenceModal = new bootstrap.Modal(document.getElementById('evidenceModal'));
    const mediaContainer = document.getElementById('mediaContainer');
    const downloadBtn = document.getElementById('downloadBtn');
    const modalTitle = document.getElementById('evidenceModalLabel');
    
    // Evidence preview handler
    document.querySelectorAll('.evidence-badge').forEach(badge => {
        badge.addEventListener('click', function() {
            const mediaType = this.getAttribute('data-type');
            const mediaSrc = this.getAttribute('data-src');
            const mediaTitle = this.getAttribute('title');
            
            // Clear previous content
            mediaContainer.innerHTML = '';
            
            // Set modal title
            modalTitle.textContent = mediaTitle;
            
            // Set download link
            downloadBtn.setAttribute('href', mediaSrc);
            downloadBtn.setAttribute('download', mediaSrc.split('/').pop());
            
            // Create appropriate media element based on type
            if (mediaType === 'image' || mediaType === 'photo') {
                const img = document.createElement('img');
                img.src = mediaSrc;
                img.alt = mediaTitle;
                img.className = 'img-fluid';
                mediaContainer.appendChild(img);
            } 
            else if (mediaType === 'video') {
                const video = document.createElement('video');
                video.src = mediaSrc;
                video.controls = true;
                video.className = 'w-100';
                mediaContainer.appendChild(video);
            } 
            else if (mediaType === 'audio') {
                const audio = document.createElement('audio');
                audio.src = mediaSrc;
                audio.controls = true;
                audio.className = 'w-100';
                mediaContainer.appendChild(audio);
            }
            else if (mediaType === 'pdf') {
                mediaContainer.innerHTML = `
                    <iframe src="${mediaSrc}" class="w-100" style="height: 70vh;" frameborder="0"></iframe>
                `;
            }
            
            evidenceModal.show();
        });
    });
    
    // Status filter functionality
    document.querySelectorAll('[data-status]').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const status = this.getAttribute('data-status');
            
            if (status === 'all') {
                document.querySelectorAll('#investigationReportsTable tbody tr').forEach(row => {
                    row.style.display = '';
                });
            } else {
                document.querySelectorAll('#investigationReportsTable tbody tr').forEach(row => {
                    row.style.display = row.getAttribute('data-status') === status ? '' : 'none';
                });
            }
        });
    });
    
    // Approve/Reject functionality
    document.querySelectorAll('.approve-btn, .reject-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const reportId = this.getAttribute('data-id');
            const action = this.classList.contains('approve-btn') ? 'approve' : 'reject';
            
            if (confirm(`Are you sure you want to ${action} this report?`)) {
                fetch(`/investigation-leader/reports/${reportId}/${action}`, {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        alert('Error: ' + (data.message || 'Action failed'));
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred');
                });
            }
        });
    });
});
</script>

@endsection