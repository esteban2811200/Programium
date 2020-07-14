<div class="modal fade modal-slide-in-right" aria-hidden="true" role="dialog" tabindex="-1" id="responder">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title"></h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">x</span>
					</button>
				</div>
				<div class="modal-body">
		<div class="col">
            <form method="post" action="{{ route('foro.responder') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="contenido_r">Escribe tu respuesta aquí</label>
                            <textarea class="form-control" id="contenido_r " name="contenido_r" required placeholder="..."></textarea>
                        </div>
                    </div>
                    <input type="hidden" name="foro" id="foro" value="{{$foro->id_foro}}">
                    <input type="hidden" name="url_response" value="{{Request::url()}}">
                    <input type="submit" class="btn btn-primary" name="enviar" value="Responder">
                </form>
                </div>
				</div>
				<div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
				</div>
			</div>
		</div>

</div>