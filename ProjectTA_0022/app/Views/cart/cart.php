<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Cart</title>
</head>
<body>
    <h1>Your Cart</h1>
    <a href="/user/products">Continue Shopping</a>
    <form action="/checkout" method="post">
        <?= csrf_field() ?>
        <table border="1">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Quantity</th>
                    <th>Price</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($cartItems)): ?>
                    <?php foreach ($cartItems as $item): ?>
                        <tr>
                            <td><?= $item['nama_produk'] ?></td>
                            <td><?= $item['jumlah'] ?></td>
                            <td><?= $item['harga'] ?></td>
                            <td><?= $item['subtotal'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4">Your cart is empty.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <?php if (!empty($cartItems)): ?>
            <button type="submit">Proceed to Checkout</button>
        <?php endif; ?>
    </form>
</body>
</html>
