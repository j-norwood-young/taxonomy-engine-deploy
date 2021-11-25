<?php
# Generated by the protocol buffer compiler.  DO NOT EDIT!
# source: google/cloud/automl/v1/io.proto

namespace Google\Cloud\AutoMl\V1;

use Google\Protobuf\Internal\GPBType;
use Google\Protobuf\Internal\RepeatedField;
use Google\Protobuf\Internal\GPBUtil;

/**
 * Output configuration for BatchPredict Action.
 * As destination the
 * [gcs_destination][google.cloud.automl.v1.BatchPredictOutputConfig.gcs_destination]
 * must be set unless specified otherwise for a domain. If gcs_destination is
 * set then in the given directory a new directory is created. Its name
 * will be
 * "prediction-<model-display-name>-<timestamp-of-prediction-call>",
 * where timestamp is in YYYY-MM-DDThh:mm:ss.sssZ ISO-8601 format. The contents
 * of it depends on the ML problem the predictions are made for.
 *  *  For Image Classification:
 *         In the created directory files `image_classification_1.jsonl`,
 *         `image_classification_2.jsonl`,...,`image_classification_N.jsonl`
 *         will be created, where N may be 1, and depends on the
 *         total number of the successfully predicted images and annotations.
 *         A single image will be listed only once with all its annotations,
 *         and its annotations will never be split across files.
 *         Each .JSONL file will contain, per line, a JSON representation of a
 *         proto that wraps image's "ID" : "<id_value>" followed by a list of
 *         zero or more AnnotationPayload protos (called annotations), which
 *         have classification detail populated.
 *         If prediction for any image failed (partially or completely), then an
 *         additional `errors_1.jsonl`, `errors_2.jsonl`,..., `errors_N.jsonl`
 *         files will be created (N depends on total number of failed
 *         predictions). These files will have a JSON representation of a proto
 *         that wraps the same "ID" : "<id_value>" but here followed by
 *         exactly one
 * [`google.rpc.Status`](https:
 * //github.com/googleapis/googleapis/blob/master/google/rpc/status.proto)
 *         containing only `code` and `message`fields.
 *  *  For Image Object Detection:
 *         In the created directory files `image_object_detection_1.jsonl`,
 *         `image_object_detection_2.jsonl`,...,`image_object_detection_N.jsonl`
 *         will be created, where N may be 1, and depends on the
 *         total number of the successfully predicted images and annotations.
 *         Each .JSONL file will contain, per line, a JSON representation of a
 *         proto that wraps image's "ID" : "<id_value>" followed by a list of
 *         zero or more AnnotationPayload protos (called annotations), which
 *         have image_object_detection detail populated. A single image will
 *         be listed only once with all its annotations, and its annotations
 *         will never be split across files.
 *         If prediction for any image failed (partially or completely), then
 *         additional `errors_1.jsonl`, `errors_2.jsonl`,..., `errors_N.jsonl`
 *         files will be created (N depends on total number of failed
 *         predictions). These files will have a JSON representation of a proto
 *         that wraps the same "ID" : "<id_value>" but here followed by
 *         exactly one
 * [`google.rpc.Status`](https:
 * //github.com/googleapis/googleapis/blob/master/google/rpc/status.proto)
 *         containing only `code` and `message`fields.
 *  *  For Video Classification:
 *         In the created directory a video_classification.csv file, and a .JSON
 *         file per each video classification requested in the input (i.e. each
 *         line in given CSV(s)), will be created.
 *         The format of video_classification.csv is:
 * GCS_FILE_PATH,TIME_SEGMENT_START,TIME_SEGMENT_END,JSON_FILE_NAME,STATUS
 *         where:
 *         GCS_FILE_PATH,TIME_SEGMENT_START,TIME_SEGMENT_END = matches 1 to 1
 *             the prediction input lines (i.e. video_classification.csv has
 *             precisely the same number of lines as the prediction input had.)
 *         JSON_FILE_NAME = Name of .JSON file in the output directory, which
 *             contains prediction responses for the video time segment.
 *         STATUS = "OK" if prediction completed successfully, or an error code
 *             with message otherwise. If STATUS is not "OK" then the .JSON file
 *             for that line may not exist or be empty.
 *         Each .JSON file, assuming STATUS is "OK", will contain a list of
 *         AnnotationPayload protos in JSON format, which are the predictions
 *         for the video time segment the file is assigned to in the
 *         video_classification.csv. All AnnotationPayload protos will have
 *         video_classification field set, and will be sorted by
 *         video_classification.type field (note that the returned types are
 *         governed by `classifaction_types` parameter in
 *         [PredictService.BatchPredictRequest.params][]).
 *  *  For Video Object Tracking:
 *         In the created directory a video_object_tracking.csv file will be
 *         created, and multiple files video_object_trackinng_1.json,
 *         video_object_trackinng_2.json,..., video_object_trackinng_N.json,
 *         where N is the number of requests in the input (i.e. the number of
 *         lines in given CSV(s)).
 *         The format of video_object_tracking.csv is:
 * GCS_FILE_PATH,TIME_SEGMENT_START,TIME_SEGMENT_END,JSON_FILE_NAME,STATUS
 *         where:
 *         GCS_FILE_PATH,TIME_SEGMENT_START,TIME_SEGMENT_END = matches 1 to 1
 *             the prediction input lines (i.e. video_object_tracking.csv has
 *             precisely the same number of lines as the prediction input had.)
 *         JSON_FILE_NAME = Name of .JSON file in the output directory, which
 *             contains prediction responses for the video time segment.
 *         STATUS = "OK" if prediction completed successfully, or an error
 *             code with message otherwise. If STATUS is not "OK" then the .JSON
 *             file for that line may not exist or be empty.
 *         Each .JSON file, assuming STATUS is "OK", will contain a list of
 *         AnnotationPayload protos in JSON format, which are the predictions
 *         for each frame of the video time segment the file is assigned to in
 *         video_object_tracking.csv. All AnnotationPayload protos will have
 *         video_object_tracking field set.
 *  *  For Text Classification:
 *         In the created directory files `text_classification_1.jsonl`,
 *         `text_classification_2.jsonl`,...,`text_classification_N.jsonl`
 *         will be created, where N may be 1, and depends on the
 *         total number of inputs and annotations found.
 *         Each .JSONL file will contain, per line, a JSON representation of a
 *         proto that wraps input text file (or document) in
 *         the text snippet (or document) proto and a list of
 *         zero or more AnnotationPayload protos (called annotations), which
 *         have classification detail populated. A single text file (or
 *         document) will be listed only once with all its annotations, and its
 *         annotations will never be split across files.
 *         If prediction for any input file (or document) failed (partially or
 *         completely), then additional `errors_1.jsonl`, `errors_2.jsonl`,...,
 *         `errors_N.jsonl` files will be created (N depends on total number of
 *         failed predictions). These files will have a JSON representation of a
 *         proto that wraps input file followed by exactly one
 * [`google.rpc.Status`](https:
 * //github.com/googleapis/googleapis/blob/master/google/rpc/status.proto)
 *         containing only `code` and `message`.
 *  *  For Text Sentiment:
 *         In the created directory files `text_sentiment_1.jsonl`,
 *         `text_sentiment_2.jsonl`,...,`text_sentiment_N.jsonl`
 *         will be created, where N may be 1, and depends on the
 *         total number of inputs and annotations found.
 *         Each .JSONL file will contain, per line, a JSON representation of a
 *         proto that wraps input text file (or document) in
 *         the text snippet (or document) proto and a list of
 *         zero or more AnnotationPayload protos (called annotations), which
 *         have text_sentiment detail populated. A single text file (or
 *         document) will be listed only once with all its annotations, and its
 *         annotations will never be split across files.
 *         If prediction for any input file (or document) failed (partially or
 *         completely), then additional `errors_1.jsonl`, `errors_2.jsonl`,...,
 *         `errors_N.jsonl` files will be created (N depends on total number of
 *         failed predictions). These files will have a JSON representation of a
 *         proto that wraps input file followed by exactly one
 * [`google.rpc.Status`](https:
 * //github.com/googleapis/googleapis/blob/master/google/rpc/status.proto)
 *         containing only `code` and `message`.
 *   *  For Text Extraction:
 *         In the created directory files `text_extraction_1.jsonl`,
 *         `text_extraction_2.jsonl`,...,`text_extraction_N.jsonl`
 *         will be created, where N may be 1, and depends on the
 *         total number of inputs and annotations found.
 *         The contents of these .JSONL file(s) depend on whether the input
 *         used inline text, or documents.
 *         If input was inline, then each .JSONL file will contain, per line,
 *           a JSON representation of a proto that wraps given in request text
 *           snippet's "id" (if specified), followed by input text snippet,
 *           and a list of zero or more
 *           AnnotationPayload protos (called annotations), which have
 *           text_extraction detail populated. A single text snippet will be
 *           listed only once with all its annotations, and its annotations will
 *           never be split across files.
 *         If input used documents, then each .JSONL file will contain, per
 *           line, a JSON representation of a proto that wraps given in request
 *           document proto, followed by its OCR-ed representation in the form
 *           of a text snippet, finally followed by a list of zero or more
 *           AnnotationPayload protos (called annotations), which have
 *           text_extraction detail populated and refer, via their indices, to
 *           the OCR-ed text snippet. A single document (and its text snippet)
 *           will be listed only once with all its annotations, and its
 *           annotations will never be split across files.
 *         If prediction for any text snippet failed (partially or completely),
 *         then additional `errors_1.jsonl`, `errors_2.jsonl`,...,
 *         `errors_N.jsonl` files will be created (N depends on total number of
 *         failed predictions). These files will have a JSON representation of a
 *         proto that wraps either the "id" : "<id_value>" (in case of inline)
 *         or the document proto (in case of document) but here followed by
 *         exactly one
 * [`google.rpc.Status`](https:
 * //github.com/googleapis/googleapis/blob/master/google/rpc/status.proto)
 *         containing only `code` and `message`.
 *  *  For Tables:
 *         Output depends on whether
 * [gcs_destination][google.cloud.automl.v1p1beta.BatchPredictOutputConfig.gcs_destination]
 *         or
 * [bigquery_destination][google.cloud.automl.v1p1beta.BatchPredictOutputConfig.bigquery_destination]
 *         is set (either is allowed).
 *         Google Cloud Storage case:
 *           In the created directory files `tables_1.csv`, `tables_2.csv`,...,
 *           `tables_N.csv` will be created, where N may be 1, and depends on
 *           the total number of the successfully predicted rows.
 *           For all CLASSIFICATION
 * [prediction_type-s][google.cloud.automl.v1p1beta.TablesModelMetadata.prediction_type]:
 *             Each .csv file will contain a header, listing all columns'
 * [display_name-s][google.cloud.automl.v1p1beta.ColumnSpec.display_name]
 *             given on input followed by M target column names in the format of
 * "<[target_column_specs][google.cloud.automl.v1p1beta.TablesModelMetadata.target_column_spec]
 * [display_name][google.cloud.automl.v1p1beta.ColumnSpec.display_name]>_<target
 *             value>_score" where M is the number of distinct target values,
 *             i.e. number of distinct values in the target column of the table
 *             used to train the model. Subsequent lines will contain the
 *             respective values of successfully predicted rows, with the last,
 *             i.e. the target, columns having the corresponding prediction
 *             [scores][google.cloud.automl.v1p1beta.TablesAnnotation.score].
 *           For REGRESSION and FORECASTING
 * [prediction_type-s][google.cloud.automl.v1p1beta.TablesModelMetadata.prediction_type]:
 *             Each .csv file will contain a header, listing all columns'
 *             [display_name-s][google.cloud.automl.v1p1beta.display_name]
 *             given on input followed by the predicted target column with name
 *             in the format of
 * "predicted_<[target_column_specs][google.cloud.automl.v1p1beta.TablesModelMetadata.target_column_spec]
 * [display_name][google.cloud.automl.v1p1beta.ColumnSpec.display_name]>"
 *             Subsequent lines will contain the respective values of
 *             successfully predicted rows, with the last, i.e. the target,
 *             column having the predicted target value.
 *             If prediction for any rows failed, then an additional
 *             `errors_1.csv`, `errors_2.csv`,..., `errors_N.csv` will be
 *             created (N depends on total number of failed rows). These files
 *             will have analogous format as `tables_*.csv`, but always with a
 *             single target column having
 * [`google.rpc.Status`](https:
 * //github.com/googleapis/googleapis/blob/master/google/rpc/status.proto)
 *             represented as a JSON string, and containing only `code` and
 *             `message`.
 *         BigQuery case:
 * [bigquery_destination][google.cloud.automl.v1p1beta.OutputConfig.bigquery_destination]
 *           pointing to a BigQuery project must be set. In the given project a
 *           new dataset will be created with name
 *           `prediction_<model-display-name>_<timestamp-of-prediction-call>`
 *           where <model-display-name> will be made
 *           BigQuery-dataset-name compatible (e.g. most special characters will
 *           become underscores), and timestamp will be in
 *           YYYY_MM_DDThh_mm_ss_sssZ "based on ISO-8601" format. In the dataset
 *           two tables will be created, `predictions`, and `errors`.
 *           The `predictions` table's column names will be the input columns'
 * [display_name-s][google.cloud.automl.v1p1beta.ColumnSpec.display_name]
 *           followed by the target column with name in the format of
 * "predicted_<[target_column_specs][google.cloud.automl.v1p1beta.TablesModelMetadata.target_column_spec]
 * [display_name][google.cloud.automl.v1p1beta.ColumnSpec.display_name]>"
 *           The input feature columns will contain the respective values of
 *           successfully predicted rows, with the target column having an
 *           ARRAY of
 * [AnnotationPayloads][google.cloud.automl.v1p1beta.AnnotationPayload],
 *           represented as STRUCT-s, containing
 *           [TablesAnnotation][google.cloud.automl.v1p1beta.TablesAnnotation].
 *           The `errors` table contains rows for which the prediction has
 *           failed, it has analogous input columns while the target column name
 *           is in the format of
 * "errors_<[target_column_specs][google.cloud.automl.v1p1beta.TablesModelMetadata.target_column_spec]
 * [display_name][google.cloud.automl.v1p1beta.ColumnSpec.display_name]>",
 *           and as a value has
 * [`google.rpc.Status`](https:
 * //github.com/googleapis/googleapis/blob/master/google/rpc/status.proto)
 *           represented as a STRUCT, and containing only `code` and `message`.
 *
 * Generated from protobuf message <code>google.cloud.automl.v1.BatchPredictOutputConfig</code>
 */
class BatchPredictOutputConfig extends \Google\Protobuf\Internal\Message
{
    protected $destination;

    /**
     * Constructor.
     *
     * @param array $data {
     *     Optional. Data for populating the Message object.
     *
     *     @type \Google\Cloud\AutoMl\V1\GcsDestination $gcs_destination
     *           Required. The Google Cloud Storage location of the directory where the output is to
     *           be written to.
     * }
     */
    public function __construct($data = NULL) {
        \GPBMetadata\Google\Cloud\Automl\V1\Io::initOnce();
        parent::__construct($data);
    }

    /**
     * Required. The Google Cloud Storage location of the directory where the output is to
     * be written to.
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.GcsDestination gcs_destination = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @return \Google\Cloud\AutoMl\V1\GcsDestination|null
     */
    public function getGcsDestination()
    {
        return $this->readOneof(1);
    }

    public function hasGcsDestination()
    {
        return $this->hasOneof(1);
    }

    /**
     * Required. The Google Cloud Storage location of the directory where the output is to
     * be written to.
     *
     * Generated from protobuf field <code>.google.cloud.automl.v1.GcsDestination gcs_destination = 1 [(.google.api.field_behavior) = REQUIRED];</code>
     * @param \Google\Cloud\AutoMl\V1\GcsDestination $var
     * @return $this
     */
    public function setGcsDestination($var)
    {
        GPBUtil::checkMessage($var, \Google\Cloud\AutoMl\V1\GcsDestination::class);
        $this->writeOneof(1, $var);

        return $this;
    }

    /**
     * @return string
     */
    public function getDestination()
    {
        return $this->whichOneof("destination");
    }

}

