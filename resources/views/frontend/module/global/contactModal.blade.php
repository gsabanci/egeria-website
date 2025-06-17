<div class="modal fade" id="timeUpModal" tabindex="-1" role="dialog" aria-labelledby="timeUpModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg c-modal" role="document">
    <div class="modal-content c-modal__content">
        <div class="modal-header c-modal__header">
            <div class="c-modal__close" data-dismiss="modal" aria-label="Close">
                <svg class="c-icon__svg c-icon--sm">
                    <use xlink:href="{{ asset('frontend/assets/images/sprite.svg#close') }}"></use>
                </svg>
                <span>Kapat</span>
            </div>
        </div>  
        <div class="modal-body c-modal__body">
            @include('frontend.module.contact.form')
        </div>
    </div>
  </div>
</div>