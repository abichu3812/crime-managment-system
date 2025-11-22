@extends('investigation_leader.investigation_leader_dashboard')
@section('investigation_leader')

<div class="page-content" style="padding: 25px 15px;">

    <!-- Breadcrumb Navigation -->


    <!-- Members Table Section -->
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card shadow-lg border-0">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="card-title text-primary mb-0">
                            <i class="fas fa-user-shield mr-2"></i> All Suspect Report From Community
                        </h4>
                        <div class="search-box">
                            <div class="input-group">
                                <input type="text" id="tableSearch" class="form-control" placeholder="Search records...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table id="criminalRecordsTable" class="table table-hover table-bordered">
                            <thead class="bg-gradient-primary text-white">
                                <tr>
                                <th style="font-size: 17px; color: white; font-weight: bold;">ID</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Full Name</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Age</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Gender</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Description</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Address</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Video</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Audio</th>
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Last Known Location</th>
                                    
                                    <th style="font-size: 17px; color: white; font-weight: bold;">Status</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($types as $key => $items)
                                    <tr class="hover-shadow">
                                    <td>{{ $key + 1 }}</td>
                                        <td>{{ $items->full_name }}</td>
                                    
                                        <td>{{ $items->age }}</td>
                                        <td>{{ $items->gender }}</td>
                                        <td>{{ $items->description }}</td>
                                      
                                        <td>{{ $items->address }}</td>

                                        <td>{{ $items->video_path }}</td>
                                        <td>{{ $items->audio_path }}</td>
 
                                        <td>{{ $items->last_known_location }}</td>

                                       
                                
                                        <td>{{ $items->status }}</td>
                                    
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

<!-- Advanced Image Viewer Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
        <div class="modal-content border-0">
            <div class="modal-header bg-gradient-primary text-white">
                <h5 class="modal-title" id="imageModalTitle">
                    <i class="fas fa-user mr-2"></i> Criminal Photo
                </h5>
                <div class="d-flex">
                    <button type="button" class="btn btn-sm btn-light mr-2" id="rotateLeft" title="Rotate Left">
                        <i class="fas fa-undo"></i>
                    </button>
                    <button type="button" class="btn btn-sm btn-light mr-2" id="rotateRight" title="Rotate Right">
                        <i class="fas fa-redo"></i>
                    </button>
                    <button type="button" class="close text-white" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
            <div class="modal-body p-0 d-flex justify-content-center align-items-center" style="min-height: 60vh; background-color: #f8f9fa;">
                <div class="image-viewer-container" style="position: relative; overflow: hidden;">
                    <img id="modalImage" src="" class="img-fluid" alt="Enlarged Photo" 
                         style="cursor: grab; transition: transform 0.3s ease; max-height: 70vh; object-fit: contain;">
                    <div class="zoom-controls" style="position: absolute; bottom: 20px; right: 20px; z-index: 1000;">
                        <button class="btn btn-sm btn-primary zoom-in shadow" title="Zoom In">
                            <i class="fas fa-search-plus"></i>
                        </button>
                        <button class="btn btn-sm btn-secondary zoom-out shadow" title="Zoom Out" disabled>
                            <i class="fas fa-search-minus"></i>
                        </button>
                        <button class="btn btn-sm btn-info zoom-reset shadow" title="Reset Zoom">
                            <i class="fas fa-sync-alt"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="modal-footer bg-light">
                <div class="mr-auto">
                    <span id="zoomPercentage" class="badge badge-light">100%</span>
                </div>
                <button type="button" class="btn btn-outline-secondary mr-2" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Close
                </button>
                <button type="button" class="btn btn-primary" id="downloadImage">
                    <i class="fas fa-download mr-1"></i> Download
                </button>
            </div>
        </div>
    </div>
</div>

<style>
    /* Main Styles */
    .bg-gradient-primary {
        background: linear-gradient(135deg, #2c3e50 0%,rgb(14, 52, 77) 100%) !important;
    }
    
    /* Table Styles */
    .table th {
        vertical-align: middle;
        border-top: none;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.8rem;
        letter-spacing: 0.5px;
    }
    
    .table td {
        vertical-align: middle;
    }
    
    .hover-shadow:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
        transform: translateY(-2px);
        transition: all 0.3s ease;
    }
    
    /* Badge Styles */
    .badge-pink {
        background-color: #e83e8c;
        color: white;
    }
    
    /* Profile Thumbnail Styles */
    .profile-thumbnail-container {
        position: relative;
        display: inline-block;
        width: 50px;
        height: 50px;
    }
    
    .profile-thumbnail-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: all 0.3s ease;
    }
    
    .photo-hover-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0,0,0,0.5);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        opacity: 0;
        transition: opacity 0.3s ease;
    }
    
    .profile-thumbnail-container:hover .photo-hover-overlay {
        opacity: 1;
    }
    
    .profile-thumbnail-container:hover img {
        transform: scale(1.1);
    }
    
    /* Modal Styles */
    .modal-content {
        border-radius: 0.5rem;
        overflow: hidden;
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }
    
    .zoom-controls .btn {
        width: 36px;
        height: 36px;
        padding: 0;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        margin: 0 3px;
    }
    
    /* Responsive Adjustments */
    @media (max-width: 768px) {
        .table-responsive {
            border: none;
        }
        
        .card-title {
            font-size: 1.2rem;
        }
        
        .search-box {
            width: 100%;
            margin-top: 10px;
        }
    }
    
    /* Flag Icons */
    .flag-icon {
        width: 1.5em;
        height: 1.5em;
        border-radius: 50%;
        box-shadow: 0 0 3px rgba(0,0,0,0.2);
    }
</style>

<script>
$(document).ready(function() {
    let currentScale = 1;
    let currentRotation = 0;
    const scaleStep = 0.25;
    const maxScale = 4;
    let currentImageSrc = '';
    let isDragging = false;
    let startPos = { x: 0, y: 0 };
    let translatePos = { x: 0, y: 0 };
    
    // Initialize the image viewer
    function initImageViewer() {
        $('.clickable-photo').click(function() {
            currentImageSrc = $(this).data('fullsrc');
            const name = $(this).data('name');
            
            $('#modalImage').attr('src', currentImageSrc);
            $('#imageModalTitle').html(`<i class="fas fa-user mr-2"></i> ${name}'s Photo`);
            resetViewer();
            $('#imageModal').modal('show');
        });
        
        // Setup panning functionality
        const modalImage = $('#modalImage');
        
        modalImage.on('mousedown touchstart', function(e) {
            if (currentScale > 1) {
                isDragging = true;
                startPos = {
                    x: e.type === 'mousedown' ? e.pageX : e.originalEvent.touches[0].pageX,
                    y: e.type === 'mousedown' ? e.pageY : e.originalEvent.touches[0].pageY
                };
                $(this).css('cursor', 'grabbing');
                e.preventDefault();
            }
        });
        
        $(document).on('mousemove touchmove', function(e) {
            if (isDragging) {
                const currentPos = {
                    x: e.type === 'mousemove' ? e.pageX : e.originalEvent.touches[0].pageX,
                    y: e.type === 'mousemove' ? e.pageY : e.originalEvent.touches[0].pageY
                };
                
                translatePos.x += (currentPos.x - startPos.x) / currentScale;
                translatePos.y += (currentPos.y - startPos.y) / currentScale;
                
                startPos = currentPos;
                
                updateViewer();
            }
        });
        
        $(document).on('mouseup touchend', function() {
            if (isDragging) {
                isDragging = false;
                modalImage.css('cursor', 'grab');
            }
        });
        
        // Zoom functionality
        $('.zoom-in').click(function() {
            if (currentScale < maxScale) {
                currentScale += scaleStep;
                updateViewer();
                toggleZoomButtons();
            }
        });
        
        $('.zoom-out').click(function() {
            if (currentScale > 1) {
                currentScale -= scaleStep;
                updateViewer();
                toggleZoomButtons();
            }
        });
        
        $('.zoom-reset').click(function() {
            resetViewer();
        });
        
        // Rotate functionality
        $('#rotateLeft').click(function() {
            currentRotation -= 90;
            updateViewer();
        });
        
        $('#rotateRight').click(function() {
            currentRotation += 90;
            updateViewer();
        });
        
        // Image click to zoom in/out
        modalImage.click(function(e) {
            if (!isDragging && e.target === this) {
                if (currentScale === 1) {
                    currentScale = 1.5;
                } else {
                    currentScale = 1;
                    translatePos = { x: 0, y: 0 };
                }
                updateViewer();
                toggleZoomButtons();
            }
        });
        
        // Download image
        $('#downloadImage').click(function() {
            if (currentImageSrc) {
                const link = document.createElement('a');
                link.href = currentImageSrc;
                link.download = 'criminal_photo_' + new Date().toISOString().slice(0,10) + '.jpg';
                document.body.appendChild(link);
                link.click();
                document.body.removeChild(link);
                
                // Show download confirmation
                const originalText = $(this).html();
                $(this).html('<i class="fas fa-check mr-1"></i> Downloaded');
                setTimeout(() => {
                    $(this).html(originalText);
                }, 2000);
            }
        });
        
        // Reset on modal close
        $('#imageModal').on('hidden.bs.modal', function() {
            resetViewer();
        });
    }
    
    function updateViewer() {
        const transform = `scale(${currentScale}) rotate(${currentRotation}deg) translate(${translatePos.x}px, ${translatePos.y}px)`;
        $('#modalImage').css('transform', transform);
        $('#zoomPercentage').text(`${Math.round(currentScale * 100)}%`);
    }
    
    function resetViewer() {
        currentScale = 1;
        currentRotation = 0;
        translatePos = { x: 0, y: 0 };
        $('#modalImage').css({
            'transform': 'scale(1) rotate(0deg)',
            'cursor': 'grab'
        });
        $('#zoomPercentage').text('100%');
        toggleZoomButtons();
    }
    
    function toggleZoomButtons() {
        $('.zoom-out').prop('disabled', currentScale <= 1);
        $('.zoom-in').prop('disabled', currentScale >= maxScale);
    }
    
    // Initialize DataTable with enhanced features
    $('#criminalRecordsTable').DataTable({
        "pageLength": 10,
        "responsive": true,
        "dom": '<"top"<"d-flex justify-content-between align-items-center"lf>>rt<"bottom"<"d-flex justify-content-between align-items-center"ip>><"clear">',
        "language": {
            "search": "",
            "searchPlaceholder": "Search records...",
            "lengthMenu": "Show _MENU_ entries",
            "info": "Showing _START_ to _END_ of _TOTAL_ entries",
            "infoEmpty": "No records available",
            "paginate": {
                "previous": "<i class='fas fa-chevron-left'></i>",
                "next": "<i class='fas fa-chevron-right'></i>"
            }
        },
        "initComplete": function() {
            $('.dataTables_filter input').addClass('form-control');
            $('.dataTables_length select').addClass('form-control');
        }
    });
    
    // Custom search box functionality
    $('#tableSearch').keyup(function() {
        $('#criminalRecordsTable').DataTable().search($(this).val()).draw();
    });
    
    // Initialize the image viewer
    initImageViewer();
});
</script>

@endsection