/*$('.filter-button-group').on( 'click', 'button', function() {
  var filterValue = $(this).attr('data-filter');
  $grid.isotope({ filter: filterValue });
});
*/
$(document).ready(function() {
  var $container = $(".grid"); // the container with all the elements to filter inside
  var filters = {}; //should be outside the scope of the filtering function

  /* --- read the documentation on isotope.metafizzy.co for more options --- */
  var $grid = $container.isotope({
    layoutMode: 'fitRows',
    itemSelector: '.item',
    percentPosition: true,
    fitRows: {
      gutter: 10
    }
  });

  // save some classes for later usage
  /* ---
  activeClass: adds this class to filters that are selected (active)
  comboClass: the class that indicates that the filter group is a chain filter, i.e. if you select two filters, only items with BOTH filters will be shown
  exclClass: the class that indicates that the filter group is an exclusion filter, i.e. you can only select one filter from that group at a time
  resetClass: the class for the overall reset button
  --- */
  var activeClass = "selected",
    comboClass = "combine",
    exclClass = "exclusive",
    resetClass = "reset";

  var $defaults = $("a." + activeClass + '[data-filter-value=""]');
  $(".option-set a").click(function(e) {
    // insert your link selector where it says '.option-set a'
    var $this = $(this); // cache the clicked link
    var comboFilter,
      filterAttr = "data-filter-value";
    if (resetClass && !$this.hasClass(resetClass)) {
      // defining variables
      var filterValue = $this.attr(filterAttr); // cache the filter
      var $optionSet = $this.parents(".option-set"); // cache the parent element
      var group = $optionSet.attr("data-filter-group"); // cache the parent filter group
      var filterGroup = filters[group]; // make new variable for the property being filtered
      if (!filterGroup) {
        // if the property doesn't exist
        filterGroup = filters[group] = []; // make a new empty array
      }
      var $selectAll = $optionSet.find("a[" + filterAttr + '=""]'); // cache the 'select all' button in the current group
      $("." + resetClass).removeClass(activeClass);
      comboFiltering(
        $this,
        filters,
        filterAttr,
        filterValue,
        $optionSet,
        group,
        $selectAll,
        activeClass,
        comboClass,
        exclClass
      );
      comboFilter = getComboFilter(filters); // join all the filters
      if (!comboFilter.length) $("a." + resetClass).addClass(activeClass);
      $this.toggleClass(activeClass);
    } else {
      filters = {};
      comboFilter = "";
      $(".option-set a").removeClass(activeClass);
      $(this).addClass(activeClass);
      $defaults.addClass(activeClass);
    }
    $grid.isotope({
      filter: comboFilter
    });
    e.preventDefault();
  });
});
function comboFiltering(
  $this,
  filters,
  filterAttr,
  filterValue,
  $optionSet,
  group,
  $selectAll,
  activeClass,
  comboClass,
  exclClass
) {
  // for non-exclusive groups of filters
  if (!$optionSet.hasClass(exclClass)) {
    // replace 'exclusive' with the class of your exclusive filter groups
    // if link is a filter that isn't selected
    if (!$this.hasClass(activeClass) && filterValue.length) {
      filters[group].push(filterValue); // add filter to array
      $selectAll.removeClass(activeClass); // remove the selected class from the 'select all' button
    } else if (filterValue.length) {
      // if link is a selected filter
      // remove filter from array
      // check if the filter group we're concerned with is a combination filter (.one.two instead of .one,.two)
      if ($optionSet.hasClass(comboClass)) {
        filters[group][0] = filters[group][0].replace(filterValue, ""); // delete the filter from the combined string
        if (!filters[group][0].length)
          // check if there is anything left in the string after deletion
          filters[group].splice(0, 1); // if no, remove the empty string
      } else {
        // if filter group is not a combo filter
        var curIndex = filters[group].indexOf(filterValue); // get index of filter string in array
        if (curIndex > -1) filters[group].splice(curIndex, 1); // remove the filter
      }
      if (!$optionSet.find("a." + activeClass).not($this).length)
        // if there are no remaining filters
        $selectAll.addClass(activeClass); // add the active class to the 'select all' button
    } else {
      // if link is the show all button for that group
      $optionSet.find("a." + activeClass).removeClass(activeClass); // remove the active class from all other buttons
      filters[group] = []; // clear the array of all filters
    }
    // join everything to a single string for the combined filtering groups
    if ($optionSet.hasClass(comboClass) && filters[group].length)
      filters[group] = [filters[group].join("")];
  } else {
    // for exclusive groups
    // if link is a filter that isn't selected
    if (!$this.hasClass(activeClass) && filterValue.length) {
      // run a loop for all active filters
      $optionSet.find("a." + activeClass).each(function(k, filterLink) {
        // remove all active filters in the same group from the array
        var removeFilter = $(filterLink).attr(filterAttr);
        var removeIndex = filters[group].indexOf(removeFilter);
        filters[group].splice(removeIndex, 1);
      });
      filters[group].push(filterValue); // add selected filter to array
      $optionSet.find("a." + activeClass).removeClass(activeClass); // remove the active class from all other links in the group
    } else if (filterValue.length) {
      // if link is a selected filter
      // remove filter from array
      var curIndex = filters[group].indexOf(filterValue);
      if (curIndex > -1) filters[group].splice(curIndex, 1);
      if (!$optionSet.find("a." + activeClass).not($this).length)
        // if there are no remaining filters
        $selectAll.addClass(activeClass); // add active class to 'select all' button
    } else {
      // if link is the show all button for that group
      $optionSet.find("a." + activeClass).removeClass(activeClass); // remove active class from all other buttons
      filters[group] = []; // reset all filters for this group
    }
  }
}
/* --- concat filters --- */
function getComboFilter(filters) {
  // pass the entire array of filters to the function
  var i = 0; // set counter variable as zero
  var comboFilters = []; // make a new array to save the string of filters

  for (var prop in filters) {
    // loop through all the properties in the filter array passed to the function
    var filterGroup = filters[prop]; // define variable
    // skip to next filter group if it doesn't have any values
    if (!filterGroup.length) {
      continue; // exit loop and move on with next iteration
    }
    if (i === 0) {
      // copy to new array
      comboFilters = filterGroup.slice(0);
    } else {
      var filterSelectors = [];
      // copy to fresh array
      var groupCombo = comboFilters.slice(0);
      // merge filter Groups
      for (var k = 0, len3 = filterGroup.length; k < len3; k++) {
        for (var j = 0, len2 = groupCombo.length; j < len2; j++) {
          filterSelectors.push(groupCombo[j] + filterGroup[k]);
        }
      }
      // apply filter selectors to combo filters for next group
      comboFilters = filterSelectors;
    }
    i++; // increment
  }

  var comboFilter = comboFilters.join(", ");
  return comboFilter;
}


//plugin bootstrap minus and plus
//http://jsfiddle.net/laelitenetwork/puJ6G/
$('.btn-number').click(function(e){
    e.preventDefault();
    
    fieldName = $(this).attr('data-field');
    type      = $(this).attr('data-type');
    var input = $(this).parent().parent().find("input[name='"+fieldName+"']");
    var currentVal = parseInt(input.val());
    if (!isNaN(currentVal)) {
        if(type == 'minus') {
            
            if(currentVal > input.attr('min')) {
                input.val(currentVal - 1).change();
            } 
            if(parseInt(input.val()) == input.attr('min')) {
                $(this).attr('disabled', true);
            }

        } else if(type == 'plus') {

            if(currentVal < input.attr('max')) {
                input.val(currentVal + 1).change();
            }
            if(parseInt(input.val()) == input.attr('max')) {
                $(this).attr('disabled', true);
            }

        }
    } else {
        input.val(0);
    }
});
$('.input-number').focusin(function(){
   $(this).data('oldValue', $(this).val());
});
$('.input-number').change(function() {
    
    minValue =  parseInt($(this).attr('min'));
    maxValue =  parseInt($(this).attr('max'));
    valueCurrent = parseInt($(this).val());
    
    name = $(this).attr('name');
    if(valueCurrent >= minValue) {
        $(".btn-number[data-type='minus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Ilość nie może być mniejsza niż ilość minimalna ('+minValue+')');
        $(this).val($(this).data('oldValue'));
    }
    if(valueCurrent <= maxValue) {
        $(".btn-number[data-type='plus'][data-field='"+name+"']").removeAttr('disabled')
    } else {
        alert('Ilość nie może być większa niż ilość maksymalna ('+maxValue+')');
        $(this).val($(this).data('oldValue'));
    }
    
    
});
$(".input-number").keydown(function (e) {
        // Allow: backspace, delete, tab, escape, enter and .
        if ($.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
             // Allow: Ctrl+A
            (e.keyCode == 65 && e.ctrlKey === true) || 
             // Allow: home, end, left, right
            (e.keyCode >= 35 && e.keyCode <= 39)) {
                 // let it happen, don't do anything
                 return;
        }
        // Ensure that it is a number and stop the keypress
        if ((e.shiftKey || (e.keyCode < 48 || e.keyCode > 57)) && (e.keyCode < 96 || e.keyCode > 105)) {
            e.preventDefault();
        }
    });
    
    
$('.add_to_cart').on('click', function(e) { 
    var button = $(this);
    $('#to-cart').css('top', button.offset().top).css('left', button.offset().left);
    $('#to-cart').show();
    var quantity = $(this).parent().parent().find('input[name="quantity"]').val();
    $.ajax({
    type: "POST",
    url: '/cart/add_to_cart',
    data: { element_id: $(this).attr('data-element-id'), 
        quantity: quantity,
        _token: $('input[name="_token"]').val()
        }
    }).done(function( msg ) {
        var sum = parseInt($('#cart').attr('data-totalitems'))+parseInt(quantity);
       $('#to-cart').css('top', $('#cart').offset().top).css('left', $('#cart').offset().left);
       
       $('#cart').attr('data-totalitems', sum).addClass('shake');
        setTimeout(function(){
            $('#cart').removeClass('shake');
             $('#to-cart').hide();
          },500);
    });
    return false;
});

$('.update_quantity').on('click', function(e) { 
    var button = $(this);
    var quantity = button.parent().find('input[name="quantity"]').val();
    $.ajax({
    type: "POST",
    url: '/cart/update_quantity',
    data: { row_id: button.attr('data-row-id'), 
        quantity: quantity,
        _token: $('input[name="_token"]').val()
        }
    }).done(function( msg ) {
       $('#cart').attr('data-totalitems', msg[0]);
       if(quantity > 0) {
        button.parent().parent().find('.price').html(msg[1]+' zł');
       }
       else {
           button.parent().parent().remove();
       }
       $('#subtotal').html(msg[2]+' zł');
       $('#tax').html(msg[3]+' zł');
       $('#total').html(msg[4]+' zł');
    });
    return false;
});

$('.remove_product').on('click', function(e) { 
    var button = $(this);
    $.ajax({
    type: "POST",
    url: '/cart/remove_product',
    data: { row_id: button.attr('data-row-id'),
        _token: $('input[name="_token"]').val()
        }
    }).done(function( msg ) {
       button.parent().parent().remove();
       $('#cart').attr('data-totalitems', msg[0]);
       $('#subtotal').html(msg[2]+' zł');
       $('#tax').html(msg[3]+' zł');
       $('#total').html(msg[4]+' zł');
    });
    return false;
});

 $(function () {
        $('[data-bs-toggle="modal"]').modal()
    })