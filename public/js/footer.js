// Footer Accordion Toggle Function
function toggleAccordion(button) {
    const accordionItem = button.closest('.accordion-item');
    const body = accordionItem.querySelector('.accordion-body');
    const isCurrentlyOpen = body.classList.contains('show');
    
    // Close all other accordion items
    const allItems = document.querySelectorAll('.accordion-item');
    allItems.forEach(item => {
        if (item !== accordionItem) {
            const otherBody = item.querySelector('.accordion-body');
            const otherButton = item.querySelector('.accordion-button');
            otherBody.classList.remove('show');
            otherButton.classList.remove('active');
        }
    });
    
    // Toggle current item
    if (isCurrentlyOpen) {
        body.classList.remove('show');
        button.classList.remove('active');
    } else {
        body.classList.add('show');
        button.classList.add('active');
    }
}
