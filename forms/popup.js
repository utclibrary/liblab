function move_box(an, box)
{
    var cleft = 0;
    var ctop = 0;
    var obj = an;

    while (obj.offsetParent)
    {
        cleft += obj.offsetLeft;
        ctop += obj.offsetTop;
        obj = obj.offsetParent;
    }

    box.style.left = cleft + 'px';

    ctop += an.offsetHeight + 8;

    // Handle Internet Explorer body margins,
    // which affect normal document, but not
    // absolute-positioned stuff.
    if (document.body.currentStyle &&
        document.body.currentStyle['marginTop'])
    {
        ctop += parseInt(
            document.body.currentStyle['marginTop']);
    }

    box.style.top = ctop + 'px';
}

// Shows a box if it wasn't shown yet or is hidden
// or hides it if it is currently shown
function show_hide_box(an, width, height, borderStyle)
{
    var href = an.href;
    var boxdiv = document.getElementById(href);

    if (boxdiv != null)
    {
        if (boxdiv.style.display=='none')
        {
            // Show existing box, move it
            // if document changed layout
            move_box(an, boxdiv);
            boxdiv.style.display='block';

            bringToFront(boxdiv);

            // Workaround for Konqueror/Safari
            if (!boxdiv.contents.contentWindow)
                boxdiv.contents.src = href;
        }
        else
            // Hide currently shown box.
            boxdiv.style.display='none';
        return false;
    }

    // Create box object through DOM
    boxdiv = document.createElement('div');

    // Assign id equalling to the document it will show
    boxdiv.setAttribute('id', href);

    boxdiv.style.display = 'block';
    boxdiv.style.position = 'absolute';
    boxdiv.style.width = width + 'px';
    boxdiv.style.height = height + 'px';
    boxdiv.style.border = borderStyle;
    boxdiv.style.textAlign = 'right';
    boxdiv.style.padding = '4px';
    boxdiv.style.background = '#FFFFFF';
    document.body.appendChild(boxdiv);

    var offset = 0;

    // Remove the following code if 'Close' hyperlink
    // is not needed.
    var close_href = document.createElement('a');
    close_href.href = 'javascript:void(0);';
    close_href.onclick = function()
        { show_hide_box(an, width, height, borderStyle); }
    close_href.appendChild(document.createTextNode('Close [x]'));
    boxdiv.appendChild(close_href);
    offset = close_href.offsetHeight;
    // End of 'Close' hyperlink code.

    var contents = document.createElement('iframe');
    //contents.scrolling = 'no';
    contents.overflowX = 'hidden';
    contents.overflowY = 'scroll';
    contents.frameBorder = '0';
    contents.style.width = width + 'px';
    contents.style.height = (height - offset) + 'px';

    boxdiv.contents = contents;
    boxdiv.appendChild(contents);

    move_box(an, boxdiv);

    if (contents.contentWindow)
        contents.contentWindow.document.location.replace(
            href);
    else
        contents.src = href;

    // The script has successfully shown the box,
    // prevent hyperlink navigation.
    return false;
}

function getAbsoluteDivs()
{
    var arr = new Array();
    var all_divs = document.body.getElementsByTagName("DIV");
    var j = 0;

    for (i = 0; i < all_divs.length; i++)
        if (all_divs.item(i).style.position=='absolute')
        {
            arr[j] = all_divs.item(i);
            j++;
        }

    return arr;
}

function bringToFront(obj)
{
    if (!document.getElementsByTagName)
        return;

    var divs = getAbsoluteDivs();
    var max_index = 0;
    var cur_index;

    // Compute the maximal z-index of
    // other absolute-positioned divs
    for (i = 0; i < divs.length; i++)
    {
        var item = divs[i];
        if (item == obj ||
            item.style.zIndex == '')
            continue;

        cur_index = parseInt(item.style.zIndex);
        if (max_index < cur_index)
        {
            max_index = cur_index;
        }
    }

    obj.style.zIndex = max_index + 1;
}
