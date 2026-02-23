@extends('template.admin')

@section('title', 'halaman | List Data')

@section('content')
<div class="container-list-data-perjanjian">
    <div class="text-start p-3">
        <a>List Data Perjanjian Penyewaan</a>
    </div>
    
    <form class="row row_filter mt-3" method="GET" action="{{ url('list_data/data_perjanjian') }}">
        <div class="container">
            <div class="row">
                <div class="col-2 filter-kategori">
                    <select id="filterkategori" name="filterkategori" class="form-control">
                        <option value="">-- All Kategori --</option>
                        <option value="Aset" {{ request('filterkategori')=='Aset' ? 'selected' : '' }}>Aset</option>
                        <option value="Event" {{ request('filterkategori')=='Event' ? 'selected' : '' }}>Event</option>
                    </select>
                </div>
                <div class="col-2 filter-jenis">
                    <select id="filterjenis" name="filterjenis" class="form-control">
                        <option value="">-- All Jenis --</option>
                        <option value="Perorangan" {{ request('filterjenis')=='Perorangan' ? 'selected' : '' }}>Perorangan
                        </option>
                        <option value="Perusahaan" {{ request('filterjenis')=='Perusahaan' ? 'selected' : '' }}>Perusahaan
                        </option>
                    </select>
                </div>
                <div class="col-5 filter-tanggal">
                    <div class="input-group input-group-sm">
                        <span class="input-group-text">Dari</span>
                        <input type="date" name="tanggal_awal" class="form-control" 
                            value="{{ request('tanggal_awal') }}">
                        <span class="input-group-text">Sampai</span>
                        <input type="date" name="tanggal_akhir" class="form-control" 
                            value="{{ request('tanggal_akhir') }}">
                    </div>
                </div>
                <!-- Tombol Terapkan -->
                <div class="col-3 col-tombol-filter">
                    <button type="submit" class="btn btn-primary ">
                        <i class="bi bi-funnel me-1"></i>Terapkan
                    </button>
                    <a href="{{ url('list_data/data_perjanjian') }}" class="btn btn-secondary me-2">
                        Reset
                    </a>
                </div>
            </div>

            
            <div class="row mt-3 align-items-center">
                <div class="col-9 filter-search">
                    <div class="input-group input-group-sm" style="position: relative;">
                        <input type="text" 
                            name="table_search" 
                            id="search-input" 
                            class="form-control" 
                            placeholder="Cari nama mitra..."
                            value="{{ request('table_search') }}"
                            autocomplete="off">
                        
                        <!-- Loading indicator -->
                        <div class="input-group-append" id="search-loading" style="display: none;">
                            <span class="input-group-text bg-transparent border-0">
                                <i class="fas fa-spinner fa-spin text-primary"></i>
                            </span>
                        </div>
                        
                        <!-- Clear button -->
                        <div class="input-group-append" id="clear-search" style="display: none;">
                            <button class="btn btn-outline-secondary" type="button" onclick="clearSearch()">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                    </div>
                    
                    <!-- Container untuk auto-suggest dropdown (khusus nama) -->
                    <div id="suggestions-container" class="suggestions-box" style="display: none;">
                        <div id="suggestions-list"></div>
                    </div>
                </div>
            </div> 
        </div>
    </form>
     
    <div class="container card-list-data-perjanjian">
        <div class="row row-data-perjanjian">
            <div class="col-2">
                <a href="{{ url('list_data/data_perjanjian/export-excel') }}">/Excel /</a>
                <a href="#" onclick="copyAsExcelFormat()" title="Copy ke Excel">Copy</a>
            </div>
        </div>
        <div class="table-perjanjian-responsive">
            <table class="table table-perjanjian">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Tgl.Update</th>
                        <th>Kategori</th>
                        <th>Nama</th>
                        <th>Nama Perwakilan</th>
                        <th>Selaku</th>
                        <th>Jenis</th>
                        <th>Alamat</th>
                        <th>No.HP</th>
                        <th>No.Perjanjian</th>
                        <th>Lokasi Sewa</th>
                        <th>Total Harga</th>
                        <th>Statua</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($dataPerjanjian as $datper)
                    <tr>
                        <td data-label="No" class="text-center">{{ $loop->iteration }}</td>
                        <td data-label="Tanggal" class="text-center">
                            {{ \Carbon\Carbon::parse($datper->updated_at)->translatedFormat('d F Y') }}
                        </td>
                        <td data-label="Kategori" class="text-center">{{ $datper->kategori }}</td>
                        <td data-label="Nama">{{ $datper->nama }}</td>
                        <td data-label="Nama Perwakilan">{{ $datper->nama_perwakilan }}</td>
                        <td data-label="Selaku" class="text-center">{{ $datper->penyewa_selaku }}</td>
                        <td data-label="Jenis" class="text-center">{{ $datper->Jenis }}</td>
                        <td data-label="Alamat">{{ $datper->alamat }}</td>
                        <td data-label="No.HP" class="text-center">{{ $datper->no_tlpn }}</td>
                        <td data-label="No.Perjanjian" class="text-center">{{ $datper->kode_perjanjian }}</td>
                        <td data-label="Lokasi Sewa">{{ $datper->lokasi }}</td>
                        <td data-label="Total Harga">
                            Rp. {{ number_format($datper->total_harga ?? 0, 0, ',', '.') }}
                        </td>
                        <td data-label="Status" class="text-center">
                            <span class="badge bg-{{ 
                                $datper->status_calculated == 'aktif' ? 'success' : 
                                ($datper->status_calculated == 'peringatan' ? 'warning' : 
                                ($datper->status_calculated == 'mati' ? 'danger' : 'secondary'))
                            }}">
                                {{ $datper->status_calculated }}
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="12" class="text-center">Tidak ada data perjanjian ditemukan</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    // Data dari controller dengan query yang SAMA dengan export
    const dataPerjanjianGlobal = @json($dataPerjanjian);
</script>
<!-- Sertakan file JS -->
<script src="{{ asset('asset/js/copy.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function() {
    let searchTimeout;
    let currentRequest = null;
    let selectedIndex = -1;
    
    const searchInput = $('#search-input');
    const suggestionsContainer = $('#suggestions-container');
    const suggestionsList = $('#suggestions-list');
    const searchLoading = $('#search-loading');
    const clearBtn = $('#clear-search');
    
    // Event listener untuk input
    searchInput.on('keyup', function(e) {
        const searchTerm = $(this).val();
        
        // Handle keyboard navigation
        if (e.keyCode === 40) { // Down arrow
            navigateSuggestions('down');
            return;
        } else if (e.keyCode === 38) { // Up arrow
            navigateSuggestions('up');
            return;
        } else if (e.keyCode === 13) { // Enter
            e.preventDefault();
            if (selectedIndex >= 0) {
                // Jika ada suggestion yang dipilih, gunakan itu
                const selectedItem = $('.suggestion-item.selected');
                if (selectedItem.length) {
                    const nama = selectedItem.data('nama');
                    searchInput.val(nama);
                    suggestionsContainer.hide();
                    performSearch();
                }
            } else {
                // Jika tidak ada suggestion yang dipilih, langsung search
                performSearch();
            }
            return;
        } else if (e.keyCode === 27) { // Escape
            suggestionsContainer.hide();
            return;
        }
        
        // Reset selected index
        selectedIndex = -1;
        
        // Show/hide clear button
        if(searchTerm.length > 0) {
            clearBtn.show();
        } else {
            clearBtn.hide();
            suggestionsContainer.hide();
        }
        
        // Get suggestions for names
        if(searchTerm.length >= 2) {
            searchLoading.show();
            
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(function() {
                getNamaSuggestions(searchTerm);
            }, 300);
        } else {
            suggestionsContainer.hide();
        }
    });
    
    // Focus event
    searchInput.on('focus', function() {
        const searchTerm = $(this).val();
        if(searchTerm.length >= 2) {
            suggestionsContainer.show();
        }
    });
    
    // Click outside to close suggestions
    $(document).on('click', function(e) {
        if (!$(e.target).closest('.filter-search').length) {
            suggestionsContainer.hide();
        }
    });
    
    // Function to get name suggestions
    function getNamaSuggestions(query) {
        $.ajax({
            url: '{{ route("perjanjian-sewa.suggest-nama") }}',
            type: 'GET',
            data: { query: query },
            success: function(response) {
                displayNamaSuggestions(response, query);
                searchLoading.hide();
            },
            error: function(xhr) {
                console.log('Error:', xhr);
                searchLoading.hide();
            }
        });
    }
    
    // Function to display name suggestions
    function displayNamaSuggestions(data, query) {
        let html = '';
        
        if (data && data.length > 0) {
            data.forEach(function(item, index) {
                const highlightedNama = highlightText(item.nama, query);
                html += `
                    <div class="suggestion-item" 
                         data-nama="${item.nama}" 
                         data-kode="${item.kode_mitra}"
                         data-index="${index}"
                         onclick="selectNama('${item.nama.replace(/'/g, "\\'")}')">
                        <span class="nama-mitra">${highlightedNama}</span>
                        <span class="kode-mitra">${item.kode_mitra}</span>
                        <span class="kategori-mitra">${item.kategori || 'Umum'}</span>
                    </div>
                `;
            });
        } else {
            html = '<div class="no-suggestions">Tidak ada nama ditemukan</div>';
        }
        
        suggestionsList.html(html);
        suggestionsContainer.show();
    }
    
    // Function to highlight matching text
    function highlightText(text, query) {
        if (!query) return text;
        const regex = new RegExp(`(${query})`, 'gi');
        return text.replace(regex, '<span class="highlight">$1</span>');
    }
    
    // Function to navigate suggestions with keyboard
    function navigateSuggestions(direction) {
        const items = $('.suggestion-item');
        if (items.length === 0) return;
        
        items.removeClass('selected');
        
        if (direction === 'down') {
            selectedIndex = Math.min(selectedIndex + 1, items.length - 1);
        } else if (direction === 'up') {
            selectedIndex = Math.max(selectedIndex - 1, -1);
        }
        
        if (selectedIndex >= 0) {
            $(items[selectedIndex]).addClass('selected');
            
            // Scroll to selected item
            const container = suggestionsContainer;
            const selectedItem = $(items[selectedIndex]);
            const itemTop = selectedItem.position().top;
            const containerHeight = container.height();
            const itemHeight = selectedItem.outerHeight();
            
            if (itemTop < 0 || itemTop + itemHeight > containerHeight) {
                container.scrollTop(container.scrollTop() + itemTop - 50);
            }
            
            // Update input with selected name
            const selectedNama = $(items[selectedIndex]).data('nama');
            searchInput.val(selectedNama);
        } else {
            // Reset to original search term
            searchInput.val(searchInput.data('original') || '');
        }
    }
    
    // Function to perform search
    function performSearch() {
        let searchTerm = searchInput.val();
        
        // Cancel previous request
        if(currentRequest) {
            currentRequest.abort();
        }
        
        // Get filter values
        let filterKategori = $('select[name="filterkategori"]').val() || '';
        let filterJenis = $('select[name="filterjenis"]').val() || '';
        let tanggalAwal = $('input[name="tanggal_awal"]').val() || '';
        let tanggalAkhir = $('input[name="tanggal_akhir"]').val() || '';
        
        // Show loading
        searchLoading.show();
        
        // Make AJAX request
        currentRequest = $.ajax({
            url: '{{ route("perjanjian-sewa.search") }}',
            type: 'GET',
            data: {
                table_search: searchTerm,
                filterkategori: filterKategori,
                filterjenis: filterJenis,
                tanggal_awal: tanggalAwal,
                tanggal_akhir: tanggalAkhir,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                $('#table-container').html(response.html);
                $('#results-count').text('Menampilkan ' + response.count + ' hasil');
                searchLoading.hide();
                
                // Highlight nama in table
                if(searchTerm.length > 0) {
                    highlightNamaInTable(searchTerm);
                }
            },
            error: function(xhr) {
                console.log('Error:', xhr);
                searchLoading.hide();
            },
            complete: function() {
                currentRequest = null;
            }
        });
    }
    
    // Function to highlight nama in table
    function highlightNamaInTable(searchTerm) {
        if(searchTerm.length < 2) return;
        
        $('#table-container tbody td:nth-child(3)').each(function() { // Kolom nama
            let html = $(this).html();
            let regex = new RegExp('(' + searchTerm + ')', 'gi');
            html = html.replace(regex, '<span class="highlight">$1</span>');
            $(this).html(html);
        });
    }
});

// Global function untuk select nama
function selectNama(nama) {
    $('#search-input').val(nama);
    $('#suggestions-container').hide();
    performSearch();
}

// Clear search function
function clearSearch() {
    $('#search-input').val('').trigger('keyup').focus();
    $('#clear-search').hide();
    $('#suggestions-container').hide();
    performSearch();
}
</script>
<style>
/* Style untuk auto-suggest */
.suggestions-box {
    position: absolute;
    z-index: 1000;
    width: 100%;
    max-height: 300px;
    overflow-y: auto;
    background: white;
    border: 1px solid #ddd;
    border-radius: 4px;
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
    margin-top: 2px;
}

.suggestions-box .suggestion-item {
    padding: 10px 15px;
    cursor: pointer;
    border-bottom: 1px solid #f0f0f0;
    transition: background-color 0.2s;
}

.suggestions-box .suggestion-item:hover {
    background-color: #e9ecef;
}

.suggestions-box .suggestion-item.selected {
    background-color: #007bff;
    color: white;
}

.suggestion-item .nama-mitra {
    font-weight: 600;
    font-size: 14px;
    color: #333;
}

.suggestion-item .kode-mitra {
    font-size: 12px;
    color: #6c757d;
    margin-left: 10px;
}

.suggestion-item .kategori-mitra {
    font-size: 11px;
    color: #28a745;
    margin-left: 10px;
    background-color: #e8f5e9;
    padding: 2px 6px;
    border-radius: 3px;
    display: inline-block;
}

.suggestion-item.selected .nama-mitra,
.suggestion-item.selected .kode-mitra,
.suggestion-item.selected .kategori-mitra {
    color: white;
}

.suggestion-item.selected .kategori-mitra {
    background-color: rgba(255,255,255,0.2);
}

/* Style untuk highlight pencarian */
.highlight {
    background-color: #ffc107;
    font-weight: bold;
    padding: 0 2px;
    border-radius: 2px;
}

.no-suggestions {
    padding: 15px;
    text-align: center;
    color: #6c757d;
    font-style: italic;
}

.filter-search {
    position: relative;
}

#search-loading {
    position: absolute;
    right: 35px;
    top: 0;
    z-index: 10;
}

.fa-spinner {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>


@endsection