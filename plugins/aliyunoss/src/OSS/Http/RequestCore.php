<?php
//多点乐资源
namespace OSS\Http;

class RequestCore
{
	const HTTP_GET = 'GET';
	const HTTP_POST = 'POST';
	const HTTP_PUT = 'PUT';
	const HTTP_DELETE = 'DELETE';
	const HTTP_HEAD = 'HEAD';

	/**
     * The URL being requested.
     */
	public $request_url;
	/**
     * The headers being sent in the request.
     */
	public $request_headers;
	/**
     * The body being sent in the request.
     */
	public $request_body;
	/**
     * The response returned by the request.
     */
	public $response;
	/**
     * The headers returned by the request.
     */
	public $response_headers;
	/**
     * The body returned by the request.
     */
	public $response_body;
	/**
     * The HTTP status code returned by the request.
     */
	public $response_code;
	/**
     * Additional response data.
     */
	public $response_info;
	/**
     * The handle for the cURL object.
     */
	public $curl_handle;
	/**
     * The method by which the request is being made.
     */
	public $method;
	/**
     * Stores the proxy settings to use for the request.
     */
	public $proxy;
	/**
     * The username to use for the request.
     */
	public $username;
	/**
     * The password to use for the request.
     */
	public $password;
	/**
     * Custom CURLOPT settings.
     */
	public $curlopts;
	/**
     * The state of debug mode.
     */
	public $debug_mode = false;
	/**
     * The default class to use for HTTP Requests (defaults to <RequestCore>).
     */
	public $request_class = 'OSS\\Http\\RequestCore';
	/**
     * The default class to use for HTTP Responses (defaults to <ResponseCore>).
     */
	public $response_class = 'OSS\\Http\\ResponseCore';
	/**
     * Default useragent string to use.
     */
	public $useragent = 'RequestCore/1.4.3';
	/**
     * File to read from while streaming up.
     */
	public $read_file;
	/**
     * The resource to read from while streaming up.
     */
	public $read_stream;
	/**
     * The size of the stream to read from.
     */
	public $read_stream_size;
	/**
     * The length already read from the stream.
     */
	public $read_stream_read = 0;
	/**
     * File to write to while streaming down.
     */
	public $write_file;
	/**
     * The resource to write to while streaming down.
     */
	public $write_stream;
	/**
     * Stores the intended starting seek position.
     */
	public $seek_position;
	/**
     * The location of the cacert.pem file to use.
     */
	public $cacert_location = false;
	/**
     * The state of SSL certificate verification.
     */
	public $ssl_verification = true;
	/**
     * The user-defined callback function to call when a stream is read from.
     */
	public $registered_streaming_read_callback;
	/**
     * The user-defined callback function to call when a stream is written to.
     */
	public $registered_streaming_write_callback;
	/**
     * 请求超时时间， 默认是5184000秒，6天
     *
     * @var int
     */
	public $timeout = 5184000;
	/**
     * 连接超时时间，默认是10秒
     *
     * @var int
     */
	public $connect_timeout = 10;

	public function __construct($url = NULL, $proxy = NULL, $helpers = NULL)
	{
		$this->request_url = $url;
		$this->method = self::HTTP_GET;
		$this->request_headers = array();
		$this->request_body = '';
		if (isset($helpers['request']) && !empty($helpers['request'])) {
			$this->request_class = $helpers['request'];
		}

		if (isset($helpers['response']) && !empty($helpers['response'])) {
			$this->response_class = $helpers['response'];
		}

		if ($proxy) {
			$this->set_proxy($proxy);
		}

		return $this;
	}

	public function __destruct()
	{
		if (isset($this->read_file) && isset($this->read_stream)) {
			fclose($this->read_stream);
		}

		if (isset($this->write_file) && isset($this->write_stream)) {
			fclose($this->write_stream);
		}

		return $this;
	}

	public function set_credentials($user, $pass)
	{
		$this->username = $user;
		$this->password = $pass;
		return $this;
	}

	public function add_header($key, $value)
	{
		$this->request_headers[$key] = $value;
		return $this;
	}

	public function remove_header($key)
	{
		if (isset($this->request_headers[$key])) {
			unset($this->request_headers[$key]);
		}

		return $this;
	}

	public function set_method($method)
	{
		$this->method = strtoupper($method);
		return $this;
	}

	public function set_useragent($ua)
	{
		$this->useragent = $ua;
		return $this;
	}

	public function set_body($body)
	{
		$this->request_body = $body;
		return $this;
	}

	public function set_request_url($url)
	{
		$this->request_url = $url;
		return $this;
	}

	public function set_curlopts($curlopts)
	{
		$this->curlopts = $curlopts;
		return $this;
	}

	public function set_read_stream_size($size)
	{
		$this->read_stream_size = $size;
		return $this;
	}

	public function set_read_stream($resource, $size = NULL)
	{
		if (!isset($size) || ($size < 0)) {
			$stats = fstat($resource);
			if ($stats && (0 <= $stats['size'])) {
				$position = ftell($resource);
				if (($position !== false) && (0 <= $position)) {
					$size = $stats['size'] - $position;
				}
			}
		}

		$this->read_stream = $resource;
		return $this->set_read_stream_size($size);
	}

	public function set_read_file($location)
	{
		$this->read_file = $location;
		$read_file_handle = fopen($location, 'r');
		return $this->set_read_stream($read_file_handle);
	}

	public function set_write_stream($resource)
	{
		$this->write_stream = $resource;
		return $this;
	}

	public function set_write_file($location)
	{
		$this->write_file = $location;
		$write_file_handle = fopen($location, 'w');
		return $this->set_write_stream($write_file_handle);
	}

	public function set_proxy($proxy)
	{
		$proxy = parse_url($proxy);
		$proxy['user'] = isset($proxy['user']) ? $proxy['user'] : null;
		$proxy['pass'] = isset($proxy['pass']) ? $proxy['pass'] : null;
		$proxy['port'] = isset($proxy['port']) ? $proxy['port'] : null;
		$this->proxy = $proxy;
		return $this;
	}

	public function set_seek_position($position)
	{
		$this->seek_position = isset($position) ? (int) $position : null;
		return $this;
	}

	public function register_streaming_read_callback($callback)
	{
		$this->registered_streaming_read_callback = $callback;
		return $this;
	}

	public function register_streaming_write_callback($callback)
	{
		$this->registered_streaming_write_callback = $callback;
		return $this;
	}

	public function streaming_read_callback($curl_handle, $file_handle, $length)
	{
		if ($this->read_stream_size <= $this->read_stream_read) {
			return '';
		}

		if (($this->read_stream_read == 0) && isset($this->seek_position) && ($this->seek_position !== ftell($this->read_stream))) {
			if (fseek($this->read_stream, $this->seek_position) !== 0) {
				throw new RequestCore_Exception('The stream does not support seeking and is either not at the requested position or the position is unknown.');
			}
		}

		$read = fread($this->read_stream, min($this->read_stream_size - $this->read_stream_read, $length));
		$this->read_stream_read += strlen($read);
		$out = ($read === false ? '' : $read);

		if ($this->registered_streaming_read_callback) {
			call_user_func($this->registered_streaming_read_callback, $curl_handle, $file_handle, $out);
		}

		return $out;
	}

	public function streaming_write_callback($curl_handle, $data)
	{
		$length = strlen($data);
		$written_total = 0;
		$written_last = 0;

		while ($written_total < $length) {
			$written_last = fwrite($this->write_stream, substr($data, $written_total));

			if ($written_last === false) {
				return $written_total;
			}

			$written_total += $written_last;
		}

		if ($this->registered_streaming_write_callback) {
			call_user_func($this->registered_streaming_write_callback, $curl_handle, $written_total);
		}

		return $written_total;
	}

	public function prep_request()
	{
		$curl_handle = curl_init();
		curl_setopt($curl_handle, CURLOPT_URL, $this->request_url);
		curl_setopt($curl_handle, CURLOPT_FILETIME, true);
		curl_setopt($curl_handle, CURLOPT_FRESH_CONNECT, false);
		curl_setopt($curl_handle, CURLOPT_MAXREDIRS, 5);
		curl_setopt($curl_handle, CURLOPT_HEADER, true);
		curl_setopt($curl_handle, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curl_handle, CURLOPT_TIMEOUT, $this->timeout);
		curl_setopt($curl_handle, CURLOPT_CONNECTTIMEOUT, $this->connect_timeout);
		curl_setopt($curl_handle, CURLOPT_NOSIGNAL, true);
		curl_setopt($curl_handle, CURLOPT_REFERER, $this->request_url);
		curl_setopt($curl_handle, CURLOPT_USERAGENT, $this->useragent);
		curl_setopt($curl_handle, CURLOPT_READFUNCTION, array($this, 'streaming_read_callback'));

		if ($this->ssl_verification) {
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, true);
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, 2);
		}
		else {
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($curl_handle, CURLOPT_SSL_VERIFYHOST, false);
		}

		if ($this->cacert_location === true) {
			curl_setopt($curl_handle, CURLOPT_CAINFO, dirname(__FILE__) . '/cacert.pem');
		}
		else if (is_string($this->cacert_location)) {
			curl_setopt($curl_handle, CURLOPT_CAINFO, $this->cacert_location);
		}

		if ($this->debug_mode) {
			curl_setopt($curl_handle, CURLOPT_VERBOSE, true);
		}

		if (!ini_get('safe_mode') && !ini_get('open_basedir')) {
			curl_setopt($curl_handle, CURLOPT_FOLLOWLOCATION, true);
		}

		if ($this->proxy) {
			curl_setopt($curl_handle, CURLOPT_HTTPPROXYTUNNEL, true);
			$host = $this->proxy['host'];
			$host .= ($this->proxy['port'] ? ':' . $this->proxy['port'] : '');
			curl_setopt($curl_handle, CURLOPT_PROXY, $host);
			if (isset($this->proxy['user']) && isset($this->proxy['pass'])) {
				curl_setopt($curl_handle, CURLOPT_PROXYUSERPWD, $this->proxy['user'] . ':' . $this->proxy['pass']);
			}
		}

		if ($this->username && $this->password) {
			curl_setopt($curl_handle, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
			curl_setopt($curl_handle, CURLOPT_USERPWD, $this->username . ':' . $this->password);
		}

		if (extension_loaded('zlib')) {
			curl_setopt($curl_handle, CURLOPT_ENCODING, '');
		}

		if (isset($this->request_headers) && count($this->request_headers)) {
			$temp_headers = array();

			foreach ($this->request_headers as $k => $v) {
				$temp_headers[] = $k . ': ' . $v;
			}

			curl_setopt($curl_handle, CURLOPT_HTTPHEADER, $temp_headers);
		}

		switch ($this->method) {
		case self::HTTP_PUT:
			curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, 'PUT');

			if (isset($this->read_stream)) {
				if (!isset($this->read_stream_size) || ($this->read_stream_size < 0)) {
					throw new RequestCore_Exception('The stream size for the streaming upload cannot be determined.');
				}

				curl_setopt($curl_handle, CURLOPT_INFILESIZE, $this->read_stream_size);
				curl_setopt($curl_handle, CURLOPT_UPLOAD, true);
			}
			else {
				curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $this->request_body);
			}

			break;

		case self::HTTP_POST:
			curl_setopt($curl_handle, CURLOPT_POST, true);
			curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $this->request_body);
			break;

		case self::HTTP_HEAD:
			curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, self::HTTP_HEAD);
			curl_setopt($curl_handle, CURLOPT_NOBODY, 1);
			break;

		default:
			curl_setopt($curl_handle, CURLOPT_CUSTOMREQUEST, $this->method);

			if (isset($this->write_stream)) {
				curl_setopt($curl_handle, CURLOPT_WRITEFUNCTION, array($this, 'streaming_write_callback'));
				curl_setopt($curl_handle, CURLOPT_HEADER, false);
			}
			else {
				curl_setopt($curl_handle, CURLOPT_POSTFIELDS, $this->request_body);
			}

			break;
		}

		if (isset($this->curlopts) && (0 < sizeof($this->curlopts))) {
			foreach ($this->curlopts as $k => $v) {
				curl_setopt($curl_handle, $k, $v);
			}
		}

		return $curl_handle;
	}

	public function process_response($curl_handle = NULL, $response = NULL)
	{
		if ($curl_handle && $response) {
			$this->curl_handle = $curl_handle;
			$this->response = $response;
		}

		if (is_resource($this->curl_handle)) {
			$header_size = curl_getinfo($this->curl_handle, CURLINFO_HEADER_SIZE);
			$this->response_headers = substr($this->response, 0, $header_size);
			$this->response_body = substr($this->response, $header_size);
			$this->response_code = curl_getinfo($this->curl_handle, CURLINFO_HTTP_CODE);
			$this->response_info = curl_getinfo($this->curl_handle);
			$this->response_headers = explode("\r\n\r\n", trim($this->response_headers));
			$this->response_headers = array_pop($this->response_headers);
			$this->response_headers = explode("\r\n", $this->response_headers);
			array_shift($this->response_headers);
			$header_assoc = array();

			foreach ($this->response_headers as $header) {
				$kv = explode(': ', $header);
				$header_assoc[strtolower($kv[0])] = isset($kv[1]) ? $kv[1] : '';
			}

			$this->response_headers = $header_assoc;
			$this->response_headers['_info'] = $this->response_info;
			$this->response_headers['_info']['method'] = $this->method;
			if ($curl_handle && $response) {
				return new ResponseCore($this->response_headers, $this->response_body, $this->response_code);
			}
		}

		return false;
	}

	public function send_request($parse = false)
	{
		set_time_limit(0);
		$curl_handle = $this->prep_request();
		$this->response = curl_exec($curl_handle);

		if ($this->response === false) {
			throw new RequestCore_Exception('cURL resource: ' . (string) $curl_handle . '; cURL error: ' . curl_error($curl_handle) . ' (' . curl_errno($curl_handle) . ')');
		}

		$parsed_response = $this->process_response($curl_handle, $this->response);
		curl_close($curl_handle);

		if ($parse) {
			return $parsed_response;
		}

		return $this->response;
	}

	public function send_multi_request($handles, $opt = NULL)
	{
		set_time_limit(0);

		if (count($handles) === 0) {
			return array();
		}

		if (!$opt) {
			$opt = array();
		}

		$limit = (isset($opt['limit']) ? $opt['limit'] : -1);
		$handle_list = $handles;
		$http = new $this->request_class();
		$multi_handle = curl_multi_init();
		$handles_post = array();
		$added = count($handles);
		$last_handle = null;
		$count = 0;
		$i = 0;

		while ($i < $added) {
			if ((0 < $limit) && ($limit <= $i)) {
				break;
			}

			curl_multi_add_handle($multi_handle, array_shift($handles));
			$i++;
		}

		do {
			$active = false;

			while (($status = curl_multi_exec($multi_handle, $active)) === CURLM_CALL_MULTI_PERFORM) {
				if (0 < count($handles)) {
					break;
				}
			}

			$to_process = array();

			while ($done = curl_multi_info_read($multi_handle)) {
				if (0 < $done['result']) {
					throw new RequestCore_Exception('cURL resource: ' . (string) $done['handle'] . '; cURL error: ' . curl_error($done['handle']) . ' (' . $done['result'] . ')');
				}
				else if (!isset($to_process[(int) $done['handle']])) {
					$to_process[(int) $done['handle']] = $done;
				}
			}

			foreach ($to_process as $pkey => $done) {
				$response = $http->process_response($done['handle'], curl_multi_getcontent($done['handle']));
				$key = array_search($done['handle'], $handle_list, true);
				$handles_post[$key] = $response;

				if (0 < count($handles)) {
					curl_multi_add_handle($multi_handle, array_shift($handles));
				}

				curl_multi_remove_handle($multi_handle, $done['handle']);
				curl_close($done['handle']);
			}

		} while ($active || (count($handles_post) < $added));

		curl_multi_close($multi_handle);
		ksort($handles_post, SORT_NUMERIC);
		return $handles_post;
	}

	public function get_response_header($header = NULL)
	{
		if ($header) {
			return $this->response_headers[strtolower($header)];
		}

		return $this->response_headers;
	}

	public function get_response_body()
	{
		return $this->response_body;
	}

	public function get_response_code()
	{
		return $this->response_code;
	}
}


?>
