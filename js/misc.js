  $(function() {
      
        // initialize semanticUI components

        $('.ui.menu .ui.dropdown').dropdown({
            on: 'hover'
        });

        $('.ui.menu a.item')
            .on('click', function() {
                $(this).addClass('active')
                       .siblings()
                       .removeClass('active');
            });

        $('.menu .item').tab();      
      
        $('.event.example .image').dimmer({
            on: 'hover'
        });
      
      
        $('#artwork').on('click', function () {
            $('.ui.fullscreen.modal').modal('show');
        });

      // Update favorites count
      function updateFavCount() {
          const favoritesCookie = document.cookie
              .split('; ')
              .find(row => row.startsWith('favorites='));

          if (favoritesCookie) {
              const favorites = JSON.parse(decodeURIComponent(favoritesCookie.split('=')[1]));
              const count = favorites.length;

              const countLabel = document.querySelector('#favorites-link .ui.red.mini.label');
              if (countLabel) {
                  countLabel.textContent = count > 0 ? count : '';
                  countLabel.setAttribute('data-favorites-count', count);
              }
          }
      }

      // Add to favorites
      function addToFavorites(paintingID, imageFileName, title) {
          const xhr = new XMLHttpRequest();
          xhr.open('GET', `addToFavorites.php?PaintingID=${paintingID}&ImageFileName=${imageFileName}&Title=${encodeURIComponent(title)}`, true);

          xhr.onload = function() {
              if (xhr.status === 200) {
                  // Refresh favorites count
                  updateFavCount();
              } else {
                  console.error('Failed to add to favorites');
              }
          };

          xhr.send();
      }

      // Update count on load
      document.addEventListener('DOMContentLoaded', () => {
          updateFavCount();
      });

      // Make `addToFavorites` global
      window.addToFavorites = addToFavorites;
  });