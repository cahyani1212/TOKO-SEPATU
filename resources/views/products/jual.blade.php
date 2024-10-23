<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Jual Produk</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/css/bootstrap.min.css">
</head>
<body class="bg-gray-100">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2>Jual Produk: {{ $product->nama_produk }}</h2>
            </div>
            <div class="card-body">
                <form action="{{ route('products.processSell', $product->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Jumlah</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" required min="1">
                    </div>
                    <button type="submit" class="btn btn-primary">Jual</button>
                    <a href="{{ route('products.index') }}" class="btn btn-secondary">Kembali</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
