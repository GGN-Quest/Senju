'-input' : {

	P : false

	, Init : function(o_){

		var o = this;

		o.P = o_.ProcessContent;

		return o;

	}

	, Apply : function(e, o_){

		var o = this, P = o.Init(o_).P, e = e || false

			, lb = e.label||false

			, ty = e.type||false

			, plh = e.placeholder||''

			, nme = e.name||false

			, save = e.save||false

			, tag = P.create({cn:'proc-item ui-item col-0 padding-x16 text-x14 gui flex wrap'})

		;


		lb = isStr(lb) ? lb : 'Entrez une value';

		ty = (isStr(ty) ? ty : 'text').lower();

		plh = isStr(plh) ? plh : '';

		nme = isStr(nme) ? nme : 'auto-input';


		if(ty == 'text'){

			var lbx = tag.create({cn:'label col-16 text-center'}).html(lb)

				, inp = tag.create({tag:'input',cn:'col-16 text-x16 margin-t-x12'})

					.attrib('type', 'text')
				
			;

			inp.attrib('placeholder', plh);

			inp.attrib('name', nme);

			inp.attrib('value', '');

			if(isStr(save)){inp.attrib('save-cmd', 'true'); }

			inp.focus();

		}



		return tag;

	}

}
