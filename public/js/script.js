$(document).ready(function () {

  setTimeout(function () {
    $('#flash-success, #flash-error, #flash-validation, #flash-status').fadeOut('slow');
  }, 5000);

  function updateFeatureMessage() {
    const featureCount = $("#featureList .feature-item").length;
    if (featureCount === 0) {
      $("#featureList").html(
        `<p class="text-stone-500 text">No features added</p>`
      );
    }
  }

  // Initialize message on page load
  updateFeatureMessage();

  $("#addFeature").click(function () {
    let featureText = $("#featureInput").val().trim();

    if (featureText === "") {
      alert("Please enter a feature!");
      return;
    }

    // Remove "No features added" message if it's there
    $("#featureList p").remove();

    let featureHTML = `
      <div class="feature-item flex items-center justify-start gap-2 bg-stone-100 border border-stone-300 py-2 px-4 rounded text-stone-800 relative">
        <input type="hidden" name="features[]" value="${featureText}">
        <input type="hidden" class="feature-status" name="feature_status[]" value="1">
        <button type="button" class="text-green-600 flex toggleAvailability">
          <i class="ph ph-check-circle text-lg"></i>
        </button>
        <span>${featureText}</span>
        <button type="button" class="text-red-500 ml-auto removeFeature">
          <i class="ph ph-trash text-lg"></i>
        </button>
      </div>
    `;


    $("#featureList").prepend(featureHTML);
    $("#featureInput").val(""); // Clear input after adding
  });

  // Remove feature
  $(document).on("click", ".removeFeature", function () {
    $(this).closest(".feature-item").remove();
    updateFeatureMessage();
  });


  $(document).on("click", ".toggleAvailability", function () {
    let button = $(this);
    let icon = button.find("i");
    let statusInput = button.siblings(".feature-status");

    if (icon.hasClass("ph-check-circle")) {
      icon.removeClass("ph-check-circle text-green-600").addClass("ph-x-circle text-red-500");
      button.removeClass("text-green-600").addClass("text-red-500");
      statusInput.val("0");
    } else {
      icon.removeClass("ph-x-circle text-red-500").addClass("ph-check-circle text-green-600");
      button.removeClass("text-red-500").addClass("text-green-600");
      statusInput.val("1");
    }
  });



  $(".imageUpload").on("change", function (event) {
    const file = event.target.files[0]; // Selected file ko get karo
    if (file) {
      const reader = new FileReader();
      const previewContainer = $(this).siblings(".previewContainer");

      reader.onload = function (e) {
        previewContainer.html(`
                    <img src="${e.target.result}" alt="Uploaded Image" 
                         class="w-32 h-32 object-cover rounded border border-gray-300 shadow">
                `);
      };

      reader.readAsDataURL(file);
    }
  });

  // --------------------------------------------------SERVICES--------------------------------------------------------------
  // ========================================================================================================================

  let sections = [];

  $('#addSectionBtn').on('click', function (e) {
    e.preventDefault();

    const title = $('input[name="section_title"]').val().trim();
    const desc = $('textarea[name="section_description"]').val().trim();
    const imageInput = $('input[name="section_image"]')[0];
    const imageFile = imageInput.files[0];

    if (!title || !desc || !imageFile) {
      alert('Please fill all section fields and select an image.');
      return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
      const index = sections.length;

      // Save to JS array
      sections.push({
        title: title,
        description: desc,
        image: imageFile
      });

      // Create a hidden real file input to append the image
      const dt = new DataTransfer();
      dt.items.add(imageFile);

      const hiddenFileInput = $('<input>', {
        type: 'file',
        name: 'section_images[]',
        class: 'd-none real-section-image',
      })[0];
      hiddenFileInput.files = dt.files;

      // Append it to the form
      $('sectionHiddenInputs').append(hiddenFileInput);

      // Preview row
      $('#sectionsTable tbody').append(`
            <tr class="border-t border-stone-300" data-index="${index}">
                <td class="px-6 py-4">
                    <img src="${e.target.result}" alt="Section Image" class="h-8 w-8 rounded-full" />
                </td>
                <td class="px-6 py-4">${title}</td>
                <td class="px-6 py-4">
                    <div class="flex items-center gap-2 *:flex">
                        <button type="button" class="text-blue-500 editSection" data-index="${index}">
                            <i class="ph ph-note-pencil text-xl"></i>
                        </button>
                        <button type="button" class="text-red-500 removeSection" data-index="${index}">
                            <i class="ph ph-trash text-xl"></i>
                        </button>
                    </div>
                </td>
            </tr>
        `);

      // Clear inputs
      $('input[name="section_title"]').val('');
      $('textarea[name="section_description"]').val('');
      $('input[name="section_image"]').val('');
      $('.serviceSecPreviewContainer').empty();
    };

    reader.readAsDataURL(imageFile);
  });

  // Edit Section
  $(document).on('click', '.editSection', function () {
    const index = $(this).data('index');
    const section = sections[index];

    if (!section) return;

    // Refill form
    $('input[name="section_title"]').val(section.title);
    $('textarea[name="section_description"]').val(section.description);

    // Remove row + inputs + array entry
    sections.splice(index, 1);
    $(`tr[data-index="${index}"]`).remove();
    $(`input[name="section_titles[]"][data-index="${index}"]`).remove();
    $(`input[name="section_descriptions[]"][data-index="${index}"]`).remove();
    $('.real-section-image').eq(index).remove();
  });

  // Remove Section
  $(document).on('click', '.removeSection', function () {
    const index = $(this).data('index');
    sections.splice(index, 1);
    $(`tr[data-index="${index}"]`).remove();
    $(`input[name="section_titles[]"][data-index="${index}"]`).remove();
    $(`input[name="section_descriptions[]"][data-index="${index}"]`).remove();
    $('.real-section-image').eq(index).remove();
  });

  $('#saveServiceBtn').on('click', function (e) {
    e.preventDefault();

    const form = $('#addServiceForm')[0];
    const formData = new FormData(form);
    // console.log(sections);
    // Add section data manually
    sections.forEach((section, index) => {
      formData.append(`section_titles[]`, section.title);
      formData.append(`section_descriptions[]`, section.description);
      formData.append(`section_images[]`, section.image);
    });
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });
    $.ajax({
      url: form.action,
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function (res) {
        // alert('Service saved successfully!');
        window.location.href = "/service"; // adjust route if needed
      },
      error: function (err) {
        console.log(err);
        alert('Something went wrong.');
      }
    });
  });

  // EDIT SECTION DELETE
  $(document).on('click', '.removeExistingSection', function () {
    const row = $(this).closest('tr');
    const sectionId = $(this).data('section-id');

    // Enable the hidden input for submission
    row.find(`input.deleted-section[value="${sectionId}"]`).prop('disabled', false);

    // Optionally hide the row
    row.hide();
  });

  // EDIT SERVICE ADD NEW SECTIONS AND EDIT SECTIONS
  // -----------------------------------------------
  let newSections = [];

  $('#addNewSectionBtn').click(function (e) {
    e.preventDefault();
    let title = $('input[name="section_title"]').val().trim();
    let desc = $('textarea[name="section_description"]').val().trim();
    let imageInput = $('input[name="section_image"]')[0];
    let imageFile = imageInput.files[0];

    if (!title || !desc || !imageFile) {
      alert('Please fill all fields and select an image.');
      return;
    }

    const reader = new FileReader();
    reader.onload = function (e) {
      const index = newSections.length;

      newSections.push({
        title,
        description: desc,
        image: imageFile
      });

      const dt = new DataTransfer();
      dt.items.add(imageFile);

      const hiddenImageInput = $('<input>', {
        type: 'file',
        name: 'section_images[]',
        class: 'd-none new-section-image',
      })[0];
      hiddenImageInput.files = dt.files;
      $('#editSectionHiddenInputs').append(hiddenImageInput);

      $('form').append(`<input type="hidden" name="section_titles[]" value="${title}" data-index="${index}">`);
      $('form').append(`<input type="hidden" name="section_descriptions[]" value="${desc}" data-index="${index}">`);

      $('#newSectionsTable tbody').append(`
        <tr class="border-t border-stone-300" data-index="${index}">
            <td class="px-6 py-4 text-left"><img src="${e.target.result}" class="w-10 h-10 rounded" /></td>
            <td class="px-6 py-4 text-left">${title}</td>
            <td class="px-6 py-4 text-left">
                <div class="flex items-center gap-2 *:flex">
                    <button type="button" class="text-blue-500 editNewSection" data-index="${index}">
                        <i class="ph ph-note-pencil text-lg"></i>
                    </button>
                    <button type="button" class="text-red-500 removeNewSection" data-index="${index}">
                        <i class="ph ph-trash text-lg"></i>
                    </button>
                </div>
            </td>
          </tr>
      `);

      $('input[name="section_title"]').val('');
      $('textarea[name="section_description"]').val('');
      $('input[name="section_image"]').val('');
    };

    reader.readAsDataURL(imageFile);
  });

  $(document).on('click', '.removeNewSection', function () {
    const index = $(this).data('index');
    $(`tr[data-index="${index}"]`).remove();
    $(`input[name="section_titles[]"][data-index="${index}"]`).remove();
    $(`input[name="section_descriptions[]"][data-index="${index}"]`).remove();
    $('.new-section-image').eq(index).remove();
    newSections.splice(index, 1);
  });

  $(document).on('click', '.editNewSection', function () {
    const index = $(this).data('index');
    const section = newSections[index];
    if (!section) return;

    $('input[name="section_title"]').val(section.title);
    $('textarea[name="section_description"]').val(section.description);
    $('input[name="section_image"]').val('');

    newSections.splice(index, 1);
    $(`tr[data-index="${index}"]`).remove();
    $(`input[name="section_titles[]"][data-index="${index}"]`).remove();
    $(`input[name="section_descriptions[]"][data-index="${index}"]`).remove();
    $('.new-section-image').eq(index).remove();
  });


  // --------------------------------------------------Projects--------------------------------------------------------------
  // ========================================================================================================================
  $.ajaxSetup({
    headers: {
      'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
  });

  $('.deleteImageBtn').on('click', function () {
    const btn = $(this);
    const url = btn.data('url');

    if (confirm('Are you sure you want to delete this image?')) {
      $.ajax({
        url: url,
        type: 'POST', // Laravel will accept this with method override
        data: {
          _method: 'DELETE'
        },
        success: function () {
          btn.closest('.relative').remove(); // remove image preview block
        },
        error: function (xhr) {
          console.log(xhr.responseText);
          alert('Failed to delete image.');
        }
      });
    }
  });
  // --------------------------------------------------Brands--------------------------------------------------------------
  // ========================================================================================================================

  $('#resetBrandForm').on('click', function () {
    $('#brandForm')[0].reset();          // Reset form fields
    $('.previewContainer').empty();      // Clear any image preview
  });

});
