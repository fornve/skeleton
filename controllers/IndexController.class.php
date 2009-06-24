<?php
	class IndexController extends Controller
	{
		function Index()
		{
			echo $this->decorate( 'index.tpl' );
		}

		function NotFound()
		{
			header( "HTTP/1.0 404 Not Found" );
			echo $this->Decorate( "404.tpl" );
		}

		function Image( $size = null, $file )
		{
			if( !$size )
			{
				$this->OriginalImage( WORKING_DIR . $file );
			}

			$size = explode( 'x', $size );

			$image = new ImageHandler( WORKING_DIR . $file, $size[ 0 ], $size[ 1 ] );
			$image->add_borders = true;
			$image->Output();
		}

		function OriginalImage( $file )
		{
			header( "Content-Type: image/jpeg" );
			readfile( $file );
		}

		function Robots()
		{
			echo $this->Decorate( 'robots.tpl' );
		}

		function UploadImage()
		{
			// upload file
            if( $_FILES[ "image" ][ 'name' ] )
            {
                $i = 1;
                do
                {
                    $filename = "{$prefix}". $_FILES[ 'image' ][ 'name' ];
                    $prefix = $i++ .'_';
                    $file = WORKING_DIR . $filename;
                }
                while( file_exists( $file ) );

                if( move_uploaded_file( $_FILES[ 'image' ][ 'tmp_name' ], $file ) )
                {
                    return $file;
                }
                else
                {
                    return 'Error uploading file.';
                }
            }
		}

	}

