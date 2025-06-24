<section>

<div class="container">
        <h1>Ventas j</h1>
        
        <div class="container mt-5">
    <div class="table-responsive">
        <table class="table  producto-table">
            <thead>
                <tr>
                    <th>Venta ID</th>
                    <?php if (session()->get('id_perfil') == 2): ?>
                    <th>usuario ID</th>
                    <?php endif?>
                    <th>fecha</th>
                    <th>total</th>
                    <th>ver detalles</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($ventaDetalle as $detalle) : ?>
                    <tr>

                        <td><?= $detalle['id'] ?></td>
                        <?php if (session()->get('id_perfil') == 2): ?>
                        <td><?= $detalle['usuario_id'] ?></td>
                        <?php endif?>
                        <td><?= $detalle['fecha'] ?></td>
                        <td><?= date('d/m/Y H:i', strtotime($detalle['fecha'])) ?></td>
                        <td>$<?= $detalle['total_venta'] ?></td>
                        <td>
                        <form action="<?= base_url('/facturas'.$detalle['id']) ?>" method="post" style="display: inline;">
                        <button type="submit" class="btn btn-sm btn-success">factura</button>
                        <td>
                    </form>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

</section>