        </div>
        </main>
        </div>

        <!-- المودال -->
        <div class="modal fade" id="addAccordionModal" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">إضافة عنصر جديد</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="إغلاق"></button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">العنوان</label>
                            <input type="text" id="accordionTitle" class="form-control"
                                placeholder="اكتب العنوان هنا">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">المحتوى</label>
                            <textarea id="accordionBody" class="form-control" rows="3" placeholder="اكتب المحتوى هنا"></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">إلغاء</button>
                        <button type="button" class="btn btn-primary" id="saveAccordionItem">إضافة</button>
                    </div>
                </div>
            </div>
        </div>

        @include('provider.layouts.script')
        </body>

        </html>
