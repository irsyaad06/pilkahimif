# TODO: Complete WaktuPemilihan Migration, Model, Filament Resource, and Controller

## Tasks
- [x] Fix migration down() method in `database/migrations/2025_11_10_185906_waktu_pemilihan.php` to drop 'waktu_pemilihan' instead of 'voting_periods'.
- [x] Complete `app/Models/WaktuPemilihan.php`: Add fillable attributes, casts for datetime fields, and scope for active periods.
- [x] Complete `app/Filament/Resources/WaktuPemilihans/Schemas/WaktuPemilihanForm.php`: Add form components for name, waktu_mulai, waktu_berakhir, is_active.
- [x] Complete `app/Filament/Resources/WaktuPemilihans/Tables/WaktuPemilihansTable.php`: Add table columns for the fields.
- [x] Create `app/Http/Controllers/WaktuPemilihanController.php` with index and current methods for frontend use.
- [x] Add routes for WaktuPemilihanController in `routes/web.php`.
- [x] Modify Filament resource to handle only one voting period record (redirect to edit if exists, else create).
- [x] Update controller to return single period in index method.
