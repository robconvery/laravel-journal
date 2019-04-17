<div class="row">
    <div class="col">
        <div class="form-group">
            <label for="journal-entry">Journal entry</label>
            <textarea class="form-control" id="journal-entry" name="entry" rows="8">{{ $journal->entry ?? old('entry') }}</textarea>
        </div>
    </div>
</div>
