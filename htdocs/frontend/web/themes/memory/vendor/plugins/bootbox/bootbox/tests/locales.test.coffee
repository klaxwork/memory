describe "bootbox locales", ->
  beforeEach ->

    @setLocale = (locale) ->
      bootbox.setLocale locale

      d1 = bootbox.alert "foo"
      d2 = bootbox.confirm "foo", -> true

      @labels =
        ok: d1.find(".btn:first").text()
        cancel: d2.find(".btn:first").text()
        confirm: d2.find(".btn:last").text()

  describe "Invalid locale", ->
    beforeEach ->
      @setLocale "xx"

    it "shows the default OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the default CANCEL translation", ->
      expect(@labels.cancel).to.equal "Cancel"

    it "shows the default CONFIRM translation", ->
      expect(@labels.confirm).to.equal "OK"

  describe "English", ->
    beforeEach ->
      @setLocale "en"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Cancel"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "OK"

  describe "French", ->
    beforeEach ->
      @setLocale "fr"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Annuler"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "D'accord"

  describe "German", ->
    beforeEach ->
      @setLocale "de"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Abbrechen"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "Akzeptieren"

  describe "Spanish", ->
    beforeEach ->
      @setLocale "es"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Cancelar"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "Aceptar"

  describe "Portuguese", ->
    beforeEach ->
      @setLocale "br"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Cancelar"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "Sim"

  describe "Dutch", ->
    beforeEach ->
      @setLocale "nl"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Annuleren"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "Accepteren"

  describe "Russian", ->
    beforeEach ->
      @setLocale "ru"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "????????????"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "??????????????????"

  describe "Indonesian", ->
    beforeEach ->
      @setLocale "id"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Batal"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "OK"

  describe "Italian", ->
    beforeEach ->
      @setLocale "it"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Annulla"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "Conferma"

  describe "Polish", ->
    beforeEach ->
      @setLocale "pl"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Anuluj"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "Potwierd??"

  describe "Danish", ->
    beforeEach ->
      @setLocale "da"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Annuller"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "Accepter"

  describe "Chinese", ->
    describe "Taiwan", ->
      beforeEach ->
        @setLocale "zh_TW"

      it "shows the correct OK translation", ->
        expect(@labels.ok).to.equal "OK"

      it "shows the correct CANCEL translation", ->
        expect(@labels.cancel).to.equal "??????"

      it "shows the correct CONFIRM translation", ->
        expect(@labels.confirm).to.equal "??????"

    describe "China", ->
      beforeEach ->
        @setLocale "zh_CN"

      it "shows the correct OK translation", ->
        expect(@labels.ok).to.equal "OK"

      it "shows the correct CANCEL translation", ->
        expect(@labels.cancel).to.equal "??????"

      it "shows the correct CONFIRM translation", ->
        expect(@labels.confirm).to.equal "??????"

  describe "Norwegian", ->
    beforeEach ->
      @setLocale "no"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Avbryt"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "OK"

  describe "Swedish", ->
    beforeEach ->
      @setLocale "sv"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Avbryt"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "OK"

  describe "Latvian", ->
    beforeEach ->
      @setLocale "lv"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "Labi"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Atcelt"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "Apstiprin??t"

  describe "Lithuanian", ->
    beforeEach ->
      @setLocale "lt"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "Gerai"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "At??aukti"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "Patvirtinti"

  describe "Turkish", ->
    beforeEach ->
      @setLocale "tr"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "Tamam"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "??ptal"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "Onayla"

  describe "Hebrew", ->
    beforeEach ->
      @setLocale "he"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "??????????"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "??????????"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "??????????"

  describe "Greek", ->
    beforeEach ->
      @setLocale "el"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "??????????????"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "??????????????"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "??????????????????????"

  describe "Japanese", ->
    beforeEach ->
      @setLocale "ja"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "???????????????"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "??????"

  describe "Hungarian", ->
    beforeEach ->
      @setLocale "hu"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "M??gsem"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "Meger??s??t"

  describe "Croatian", ->
    beforeEach ->
      @setLocale "hr"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Odustani"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "Potvrdi"

  describe "Bulgarian", ->
    beforeEach ->
      @setLocale "bg_BG"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "????"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "??????????"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "????????????????????????"

  describe "Thai", ->
    beforeEach ->
      @setLocale "th"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "????????????"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "??????????????????"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "??????????????????"

  describe "Persian", ->
    beforeEach ->
      @setLocale "fa"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "????????"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "??????"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "??????????"

  describe "Albanian", ->
    beforeEach ->
      @setLocale "sq"

    it "shows the correct OK translation", ->
      expect(@labels.ok).to.equal "OK"

    it "shows the correct CANCEL translation", ->
      expect(@labels.cancel).to.equal "Anulo"

    it "shows the correct CONFIRM translation", ->
      expect(@labels.confirm).to.equal "Prano"
