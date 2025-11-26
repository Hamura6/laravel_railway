<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pago Matricula # <span
                        class="text-success matriculaID"></span></h5>
                <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" id="formTypePay">
                <div class="modal-body">
                    <div class="row">

                        <div class="col-md-6">
                            <label>Nombre</label>
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" id="afiliado" name="afiliado"
                                    placeholder="Nombre" aria-label="Name" aria-describedby="name-addon">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Tipo</label>
                            <div class="input-group mb-3">
                                <select name="type" id="type" class="js-example-basic-single">
                                    <option value="" disabled selected>Seleccione una opcion</option>
                                    <option value="A">Aportes</option>
                                    <option value="C">Certificacion</option>
                                    <option value="R">Renovacion</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Monto</label>
                            <div class="input-group mb-3">
                                <input type="number" class="form-control" id="amount" name="amount" min="0" max="999999"
                                    step="0.01" placeholder="00.00" aria-label="Monto" aria-describedby="monto-addon">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label>Fecha de Aporte</label>
                            <div class="input-group mb-3">
                                <input type="date" class="form-control" id="datePay" name="datePay"
                                    value="@php echo date('Y-m-d'); @endphp" placeholder="Fecha Aporte"
                                    aria-label="Fecha Aporte" aria-describedby="fecha-addon">
                            </div>
                        </div>

                        <div class="card" id="dataUnpay">
                            <div class="card-body">
                                <table class="tableDataUnpay table-striped w-100">
                                    <thead>
                                        <tr>
                                            <th class="text-center"><input type="checkbox" id="selectAll"
                                                    name="selectAll"></th>
                                            <th class="text-center">Fecha de Aporte</th>
                                            <th class="text-center">Monto</th>
                                            <th class="text-center">Tipo</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="button" class="btn btn-dark">Guardar</button>
                    <button type="button" class="btn btn-info">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>