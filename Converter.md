
SWFTools

----------------

[pdf2swf](#) - pdf2swf

-h , --help                    Print short help message and exit

-V , --version                 Print version info and exit
-o , --output file.swf         Direct output to file.swf. If file.swf contains '%' (file%.swf), then each page goes to a separate 
file.

-p , --pages range             Convert only pages in range with range e.g. 1-20 or 1,4,6,9-11 or

-P , --password password       Use password for deciphering the pdf.

-v , --verbose                 Be verbose. Use more than one -v for greater effect.

-z , --zlib                    Use Flash 6 (MX) zlib compression.

-i , --ignore                  Allows pdf2swf to change the draw order of the pdf. This may make the generated

-j , --jpegquality quality     Set quality of embedded jpeg pictures to quality. 0 is worst (small), 100 is best (big). (default:85)

-s , --set param=value         Set a SWF encoder specific parameter.  See pdf2swf -s help for more information.

-w , --samewindow              When converting pdf hyperlinks, don't make the links open a new window. 

-t , --stop                    Insert a stop() command in each page. 

-T , --flashversion num        Set Flash Version in the SWF header to num.

-F , --fontdir directory       Add directory to the font search path.

-b , --defaultviewer           Link a standard viewer to the swf file. 

-l , --defaultloader           Link a standard preloader to the swf file which will be displayed while the main swf is loading.

-B , --viewer filename         Link viewer filename to the swf file. 

-L , --preloader filename      Link preloader filename to the swf file. 

-q , --quiet                   Suppress normal messages.  Use -qq to suppress warnings, also.

-S , --shapes                  Don't use SWF Fonts, but store everything as shape.

-f , --fonts                   Store full fonts in SWF. (Don't reduce to used characters).

-G , --flatten                 Remove as many clip layers from file as possible. 

-I , --info                    Don't do actual conversion, just display a list of all pages in the PDF.

-Q , --maxtime n               Abort conversion after n seconds. Only available on Unix.



LibreOffice Writer

----------------

[lowriter](#) - lowriter

Options:

--minimized    keep startup bitmap minimized.

--invisible    no startup screen, no default document and no UI.

--norestore    suppress restart/restore after fatal errors.

--quickstart   starts the quickstart service

--nologo       don't show startup screen.

--nolockcheck  don't check for remote instances using the installation

--nodefault    don't start with an empty document

--headless     like invisible but no userinteraction at all.

--help/-h/-?   show this message and exit.

--version      display the version information.

--writer       create new text document.

--calc         create new spreadsheet document.

--draw         create new drawing.

--impress      create new presentation.

--base         create new database.

--math         create new formula.

--global       create new global document.

--web          create new HTML document.

-o             open documents regardless whether they are templates or not.

-n             always open documents as new files (use as template).



--display <display>
      
      Specify X-Display to use in Unix/X11 versions.

-p <documents...>
      
      print the specified documents on the default printer.

--pt <printer> <documents...>
      
      print the specified documents on the specified printer.

--view <documents...>
      
      open the specified documents in viewer-(readonly-)mode.

--show <presentation>
      
      open the specified presentation and start it immediately

--accept=<accept-string>
      
      Specify an UNO connect-string to create an UNO acceptor through which
      
      other programs can connect to access the API

--unaccept=<accept-string>
      
      Close an acceptor that was created with --accept=<accept-string>
      
      Use --unnaccept=all to close all open acceptors

--infilter=<filter>
      
      Force an input filter type if possible
      
      Eg. --infilter="Calc Office Open XML"

--convert-to output_file_extension[:output_filter_name] [--outdir output_dir] files
      
      Batch convert files.
      
      If --outdir is not specified then current working dir is used as output_dir.
      
      Eg. --convert-to pdf *.doc
          
          --convert-to pdf:writer_pdf_Export --outdir /home/user *.doc

--print-to-file [-printer-name printer_name] [--outdir output_dir] files
      
      Batch print files to file.
      
      If --outdir is not specified then current working dir is used as output_dir.
      
      Eg. --print-to-file *.doc
          
          --print-to-file --printer-name nasty_lowres_printer --outdir /home/user *.doc



Remaining arguments will be treated as filenames or URLs of documents to open.





LibreOffice Impress

----------------

[loimpress](#) - loimpress



Options:

--minimized    keep startup bitmap minimized.

--invisible    no startup screen, no default document and no UI.

--norestore    suppress restart/restore after fatal errors.

--quickstart   starts the quickstart service

--nologo       don't show startup screen.

--nolockcheck  don't check for remote instances using the installation

--nodefault    don't start with an empty document

--headless     like invisible but no userinteraction at all.

--help/-h/-?   show this message and exit.

--version      display the version information.

--writer       create new text document.

--calc         create new spreadsheet document.

--draw         create new drawing.

--impress      create new presentation.

--base         create new database.

--math         create new formula.

--global       create new global document.

--web          create new HTML document.

-o             open documents regardless whether they are templates or not.

-n             always open documents as new files (use as template).



--display <display>
      
      Specify X-Display to use in Unix/X11 versions.

-p <documents...>
      
      print the specified documents on the default printer.

--pt <printer> <documents...>
      
      print the specified documents on the specified printer.

--view <documents...>
      
      open the specified documents in viewer-(readonly-)mode.

--show <presentation>
      
      open the specified presentation and start it immediately

--accept=<accept-string>
      
      Specify an UNO connect-string to create an UNO acceptor through which
      
      other programs can connect to access the API

--unaccept=<accept-string>
      
      Close an acceptor that was created with --accept=<accept-string>
      
      Use --unnaccept=all to close all open acceptors

--infilter=<filter>
      
      Force an input filter type if possible
      
      Eg. --infilter="Calc Office Open XML"

--convert-to output_file_extension[:output_filter_name] [--outdir output_dir] files
      
      Batch convert files.
      
      If --outdir is not specified then current working dir is used as output_dir.
      
      Eg. --convert-to pdf *.doc
          
          --convert-to pdf:writer_pdf_Export --outdir /home/user *.doc

--print-to-file [-printer-name printer_name] [--outdir output_dir] files
      
      Batch print files to file.
      
      If --outdir is not specified then current working dir is used as output_dir.
      
      Eg. --print-to-file *.doc
          
          --print-to-file --printer-name nasty_lowres_printer --outdir /home/user *.doc



Remaining arguments will be treated as filenames or URLs of documents to open.
