/*$success = false;
$messages = [];

try {
$fullPath = Storage::path($this->filePath);
Excel::import(new TeachersImport(auth()->user()->program->id), $fullPath);
$success = true;
$messages[] = 'All teachers have been imported successfully.';
} catch (ValidationException $e) {
$failures = $e->failures();
foreach ($failures as $failure) {
$messages[] = "Row {$failure->row()}: " . implode(', ', $failure->errors());
}
} catch (\Exception $e) {
$messages[] = 'Import failed: ' . $e->getMessage();
} finally {
Storage::delete($this->filePath);
Event::dispatch(new TeachersImportCompleted($success, $messages));
}
*/
